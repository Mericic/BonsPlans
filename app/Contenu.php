<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contenu extends Model
{
    protected $primaryKey = 'id_Contenu';

    public $coordonnees;
    public $id_contenus = [];
    public $categories = [];
    public $criteres = [];
    public $images = [];
    public $contenu;

    //renvoie toutes les infos d'un contenu
    public function getContenu(){
        if(!isset($this->id_contenu))
            return -1;

        $contenu = Contenu::join('Users', 'contenus.id_User', '=', 'Users.id')
            ->where('contenus.id_contenu', '=', $this->id_contenu)
            ->select('contenus.id_contenu', 'contenus.nom_contenu', 'contenus.adresse', 'contenus.description', 'contenus.coordonneesX', 'contenus.coordonneesY', 'users.pseudo')
            ->get();

        $this->categories = Contenu::join('contenu_categories', 'contenus.id_Contenu', '=', 'contenu_categories.id_Contenu')
            ->join('Categories', 'contenu_categories.id_Categorie', '=', 'Categories.id_Categorie')
            ->where('contenus.id_contenu', '=', $this->id_contenu)
            ->select('categories.nom as nom_categorie', 'categories.id_categorie')
            ->get();

        $this->criteres = Contenu::select(DB::raw('criteres.nom as nom_critere, criteres.id_critere, AVG(votes_criteres.value) as moyenne'))
            ->join('Contenu_Criteres', 'contenus.id_Contenu', '=', 'Contenu_Criteres.id_Contenu')
            ->join('criteres', 'Contenu_Criteres.id_Critere', '=', 'criteres.id_critere')
            ->join('votes_criteres', function($join){
                $join->on('contenus.id_contenu',  '=', 'votes_criteres.id_contenu');
                $join->on('criteres.id_critere', '=', 'votes_criteres.id_critere');
            })
            ->where('contenus.id_contenu', '=', '1')
            ->groupby('criteres.id_critere')
            ->get();

        $this->images = Contenu::join('Contenu_Images', 'contenus.id_Contenu', '=', 'contenu_images.id_contenu')
            ->join('images', 'Contenu_Images.id_image', '=', 'images.id')
            ->where('contenus.id_contenu', '=', $this->id_contenu)
            ->select('nom as nom_image', 'path')
            ->get();

        $this->contenu = $contenu;
        $contenu->categories = $this->categories;
        $contenu->criteres = $this->criteres;
        $contenu->images = $this->images;

        return $contenu;
    }

    //renvoie tous les contenus qui ont les bonnes catégories et dans le périmètre,
    // return id
    public function getContenus($perimetre, $categories){

        $perimetre = explode('|', $perimetre);

        $haut = $perimetre[0];
        $bas = $perimetre[1];
        $haut = explode('&', $haut);
        $bas = explode('&', $bas);

        $hautX = $haut[0];
        $hautY = $haut[1];

        $basX = $bas[0];
        $basY = $bas[1];
        $id_Contenus = [];
        if($categories!=null){
            foreach($categories as $categorie){
                $data = Contenu::join('contenu_categories', 'contenus.id_Contenu', '=', 'contenu_categories.id_Contenu')
                    ->where('contenu_categories', 'IN', $categorie)
                    ->where('contenus.CoordonneesX', '<', $hautX)
                    ->where('contenus.Coordonneesy', '<', $hautY)
                    ->where('contenus.CoordonneesX', '>', $basX)
                    ->where('contenus.Coordonneesy', '', $basY)
                    ->select('id_Contenu')
                    ->get();
                if($data){
                    array_push($id_Contenus, $data);
                }
            }
        }else{
            $data = Contenu::join('contenu_categories', 'contenus.id_Contenu', '=', 'contenu_categories.id_Contenu')
                ->select('contenus.id_Contenu')
                ->where('contenus.CoordonneesX', '<', $hautX)
                ->where('contenus.Coordonneesy', '<', $hautY)
                ->where('contenus.CoordonneesX', '>', $basX)
                ->where('contenus.Coordonneesy', '>', $basY)
                ->get();
            dd($data);

        }
        $this->id_Contenus = $data;


        return $this->id_Contenus;

    }

    //renvoie les coordonnées pour la map avec les données récup par getContenus
    public function getAllCoordonnees(){
        $coordonnees = [];
        dd($this->id_Contenus);
        foreach($this->id_Contenus as $id_contenu){
            $data =Contenu::where('contenus.id_contenu', '=', $id_contenu[0]->id_Contenu)->select('contenus.CoordonneesX', 'contenus.CoordonneesY')->get();

            array_push($coordonnees, $data);
        }
        return $coordonnees;

    }



}
