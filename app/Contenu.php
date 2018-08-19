<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    protected $primaryKey = 'id_Contenu';

    public $coordonnees;
    public $id_contenu;

    //renvoie toutes les infos d'un contenu
    public function getContenu(){
        if(!isset($id_contenu))
            return 0;

        $contenu = Contenu::join('contenu_categories', 'contenus.id_Contenu', '=', 'contenu_categories.id_Contenu')
            ->join('Categories', 'contenu_categories.id_Categorie', '=', 'Categories.id_Categorie')
            ->join('Contenu_Criteres', 'contenus.id_Contenu', '=', 'Contenu_Criteres.id_Contenu')
            ->join('Criteres', 'Contenu_Criteres.id_Critere', '=', 'Criteres.id_Critere')
            ->join('Users', 'contenus.id_User', '=', 'Users.id')
            ->where('id_contenu', '=', $this->id_contenu)
            ->get();

        return $contenu;
    }

    //renvoie tous les contenus qui ont les bonnes catégories, sort by id
    public function sortByCategories($categories){

    }

    //renvoie les coordonnées pour la map
    public function getAllCoordonnees($perimetre, $categories){
        //deux paramètres : perimetre, qui sont des coordonnées
        //                  Catégories, qui est un JSON de chaines de caractère

        $perimetre = explode('|', $perimetre);

        $haut = $perimetre[0];
        $bas = $perimetre[1];

        $haut = explode('$', $haut);
        $bas = explode('$', $bas);

        $hautX = $haut[0];
        $hautY = $haut[1];

        $basX = $bas[0];
        $basY = $bas[1];

        $values= [];

        foreach($categories as $categorie){
            $data = Contenu::join('contenu_categories', 'contenus.id_Contenu', '=', 'contenu_categories.id_Contenu')
                ->where('contenu_categories', '=', $categorie)
                ->where('contenus.CoordonneesX', '<', $hautX)
                ->where('contenus.Coordonneesy', '<', $hautY)
                ->where('contenus.CoordonneesX', '<', $basX)
                ->where('contenus.Coordonneesy', '<', $basY)
                ->select('id_Contenu', 'Coordonnees')
                ->get();
            if($data){
                $values.push($data);
            }
        }

        return $values;


    }



}
