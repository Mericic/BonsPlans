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
    public $commentaires =[];
    public $contenu;

    //renvoie toutes les infos d'un contenu
    public function getContenu(){
        if(!isset($this->id_contenu))
            return -1;

        $this->contenu= Contenu::getContenuBRUT($this->id_contenu);
        $this->categories = $this->contenu->categories;
        $this->images = $this->contenu->images;
        $this->commentaires = $this->contenu->commentaires;
        $this->criteres = $this->contenu->criteres;
        return $this->contenu;
    }

    public static function getContenuBRUT($id_contenu){
        $contenu = Contenu::join('Users', 'contenus.id_User', '=', 'Users.id')
            ->where('contenus.id_contenu', '=', $id_contenu)
            ->select('contenus.id_contenu', 'contenus.nom_contenu', 'contenus.adresse', 'contenus.description', 'contenus.coordonneesX', 'contenus.coordonneesY', 'users.pseudo', 'users.id as id_user')
            ->first();

        $categories = Contenu::join('contenu_categories', 'contenus.id_Contenu', '=', 'contenu_categories.id_Contenu')
            ->join('Categories', 'contenu_categories.id_Categorie', '=', 'Categories.id_Categorie')
            ->where('contenus.id_contenu', '=', $id_contenu)
            ->select('categories.nom as nom_categorie', 'categories.id_categorie')
            ->get();

        $criteres = Contenu::select(DB::raw('criteres.nom as nom_critere, criteres.id_critere, AVG(votes_criteres.value) as moyenne'))
            ->join('Contenu_Criteres', 'contenus.id_Contenu', '=', 'Contenu_Criteres.id_Contenu')
            ->join('criteres', 'Contenu_Criteres.id_Critere', '=', 'criteres.id_critere')
            ->leftjoin('votes_criteres', function($join){
                $join->on('contenus.id_contenu',  '=', 'votes_criteres.id_contenu');
                $join->on('criteres.id_critere', '=', 'votes_criteres.id_critere');
            })
            ->where('contenus.id_contenu', '=', $id_contenu)
            ->groupby('criteres.id_critere')
            ->get();

//dd($this->criteres);
        $images = Contenu::join('Contenu_Images', 'contenus.id_Contenu', '=', 'contenu_images.id_contenu')
            ->join('images', 'Contenu_Images.id_image', '=', 'images.id')
            ->where('contenus.id_contenu', '=', $id_contenu)
            ->select('nom as nom_image', 'path')
            ->get();

        $commentaires = Commentaire::leftjoin('Reponses', 'Commentaires.id_Commentaire', '=', 'Reponses.id_Commentaire')
            ->join('users', 'commentaires.id_User', '=', 'users.id' )
            ->where('commentaires.id_Contenu', '=', $id_contenu)
            ->select('Commentaire', 'Reponse', 'first_name', 'last_name')
            ->get();
//dd($commentaires);
        $contenu->categories = $categories;
        $contenu->criteres = $criteres;
        $contenu->images = $images;
        $contenu->commentaires = $commentaires;

        return $contenu;
    }

    //renvoie tous les contenus qui ont les bonnes catégories et dans le périmètre,
    // return id
    public function getAllContenus(){

        return $this->id_Contenus;

    }

    public static function getContenusConsole(){
        $contenus = Contenu::join('users', 'contenus.id_Contenu', '=', 'users.id')->get();
        $returntext = "";
        foreach($contenus as $contenu){
            $returntext .= $contenu->id_Contenu.' : '.$contenu->nom_contenu.'  - créé par '.$contenu->pseudo."\n";
        }
        return $returntext;
    }

    public static function delContenuConsole($id_Contenu){
        $contenu = Contenu::findOrFail($id_Contenu);
        $contenu->delete();
        return "Contenu supprimé";
    }

    //renvoie les coordonnées pour la map avec les données récup par getContenus
    //epicentre ['latitude'=>value, 'longitude'=>value]
    public static function getContenus($epicentre, $zoom){
        return Contenu::join('users', 'contenus.id_User', '=', 'users.id')
            ->select('users.pseudo', 'contenus.*')
            ->where('contenus.CoordonneesX', '<=', $epicentre->latitude + $zoom)
            ->where('contenus.CoordonneesY', '<=', $epicentre->longitude + $zoom)
            ->where('contenus.CoordonneesX', '>=', $epicentre->latitude - $zoom)
            ->where('contenus.CoordonneesY', '>=', $epicentre->longitude - $zoom)
            ->distinct()
            ->get();
    }

    public static function getContenusFiltre($latitude, $longitude, $filtre){
        $zoom = 0.012;
        $filtre = explode('&', $filtre);
        if(count($filtre) == 2)
            $contenu = Contenu::select('contenus.*', 'users.pseudo')
                ->join('contenu_categories', 'contenus.id_Contenu', '=', 'contenu_categories.id_Contenu')
                ->join('categories', 'contenu_categories.id_Categorie', '=', 'categories.id_Categorie')
                ->join('users', 'contenus.id_User', '=', 'users.id')
                ->where('contenus.CoordonneesX', '<=', $latitude + $zoom)
                ->where('contenus.CoordonneesY', '<=', $longitude + $zoom)
                ->where('contenus.CoordonneesX', '>=', $latitude - $zoom)
                ->where('contenus.CoordonneesY', '>=', $longitude - $zoom)
                ->where('categories.nom', '=', substr($filtre[1], 8))
                ->get();
        if(count($filtre) == 3)
            $contenu = Contenu::select('contenus.*', 'users.pseudo')
                ->join('contenu_categories', 'contenus.id_Contenu', '=', 'contenu_categories.id_Contenu')
                ->join('categories', 'contenu_categories.id_Categorie', '=', 'categories.id_Categorie')
                ->join('users', 'contenus.id_User', '=', 'users.id')
                ->where('contenus.CoordonneesX', '<=', $latitude + $zoom)
                ->where('contenus.CoordonneesY', '<=', $longitude + $zoom)
                ->where('contenus.CoordonneesX', '>=', $latitude - $zoom)
                ->where('contenus.CoordonneesY', '>=', $longitude - $zoom)
                ->where('categories.nom', '=', substr($filtre[0], 8))
                ->where('categories.nom', '=', substr($filtre[1], 8))
                ->toSql();
        if(count($filtre) == 4)
            $contenu = Contenu::select('contenus.*', 'users.pseudo')
                ->join('contenu_categories', 'contenus.id_Contenu', '=', 'contenu_categories.id_Contenu')
                ->join('categories', 'contenu_categories.id_Categorie', '=', 'categories.id_Categorie')
                ->join('users', 'contenus.id_User', '=', 'users.id')
                ->where('contenus.CoordonneesX', '<=', $latitude + $zoom)
                ->where('contenus.CoordonneesY', '<=', $longitude + $zoom)
                ->where('contenus.CoordonneesX', '>=', $latitude - $zoom)
                ->where('contenus.CoordonneesY', '>=', $longitude - $zoom)
                ->where('categories.nom', '=', substr($filtre[0], 8))
                ->where('categories.nom', '=', substr($filtre[1], 8))
                ->where('categories.nom', '=', substr($filtre[2], 8))
                ->get();

        return $contenu;
    }

    public static function getContentImages($id_contenu) {
        $images = Contenu::join('Contenu_Images', 'contenus.id_Contenu', '=', 'contenu_images.id_contenu')
            ->join('images', 'Contenu_Images.id_image', '=', 'images.id')
            ->where('contenus.id_contenu', '=', $id_contenu)
            ->select('path')
            ->get();
        return ($images);
    }

}
