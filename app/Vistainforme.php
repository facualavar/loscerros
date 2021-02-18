<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tiposdeanalisi
 */
class Vistainforme extends Model
{
    protected $table = 'vistainformes';
    
    protected $primaryKey = 'Informes_idInformes';
	public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'diagnostico',
        'Informes_idInformes',
        'Informes_Pacientes_Personas_idPersonas',
        'Informes_Usuarios_Personas_idPersonas',
        'globulosRojos',
        'globulosBlancos',
        'hematocrito',
        'hemoglobina',
        'hcm',
        'vcm',
        'chcm',
        'rdw',
        'plaquetas',
        'cayados',
        'cayado',
        'neutrofilos',
        'neutrofilo',
        'eosinofilos',
        'eosinofilo',
        'basofilos',
        'basofilo',
        'linfocitos',
        'linfocito',
        'monocitos',
        'monocito',
        'observacion',
        'eritrosedimentacion',
        'recreticulocitos',
        'color',
        'aspecto',
        'densidad',
        'ph',
        'proteinas',
        'glucosaOrina',
        'cetonicos',
        'bilirrubina',
        'urobilinogeno',
        'hemoglobinaOrina',
        'nitritos',
        'epiteliales',
        'mucus',
        'leucocitos',
        'hematies',
        'cristales',
        'cilindros',
        'glucemia',
        'uremia',
        'creatinina',
        'got',
        'gpt',
        'fal',
        'directa',
        'indirecta',
        'total',
        'colesterol',
        'relacionHDL',
        'magnesio',
        'somf',
        'aspectoSuero',
        'quilomicrones',
        'betaLipoproteinas',
        'preBetaLipoproteinas',
        'alfaLipoproteinas',
        'conclusiones',
        'valorObtenido',
        'valorOrina',
        'diuresis',
        'ggt',
        'tsh',
        'tshP',
        't4l',
        't4',
        't4P',
        't3',
        't3P',
        'tpo',
        'psa',
        'insulina',
        'estradiol',
        'fsh',
        'afp',
        'ca153',
        'ca199',
        'cea',
        'ca125',
        'dheas',
        'androstenediona',
        'ige',
        'lh',
        'shbg',
        'cortisolM',
        'cortisolV',
        'testoteronaBio',
        'progesterona',
        'bhcgCual',
        'bhcgCuant',
        'vdrl',
        'vdrlCuantitativa',
        'pcr',
        'pcrCuantitativa',
        'artritest',
        'artritestCuantitativa',
        'asoLatex',
        'asoLatexCuantitativa',
        'asto',
        'asto2',
        'hiv',
        'hbc',
        'hbs',
        'hcv', 
        'monotest',
        'chagasHai',
        'chagasElisa',
        'igA',
        'inmunologiaA',
        'inmunologiaG',
        'inmunologiaE',
        'grupoRH',
        'anticuerpoAntigliadina',
        'antiendomisioLG',
        'antitransglutaminasaLG',
        'celulasEpitelialesUro',
        'leucocitosUro',
        'hematiesUro',
        'otrosUro',
        'gramUro',
        'cultivoUro',
        'examenDirecto',
        'gram',
        'cultivoBacteriologico',
        'examenParasitologico',
        'examenMicologico',
        'muestraC',
        'examenDirectoCCelulas',
        'examenDirectoCLeucocitos',
        'gramC',
        'cultivoC',
        'ptog',
        'tiempoReaccion',
        'actividad',
        'rin',
        'kptt',
        'tcoagulacion',
        'tsangria',
        'recsangria',
        'recplaquetas',
        'fibrinogeno',
        'antitiroglobulina',
        'prolactina',
        'testosteronaLibre',
        'testosteronaTotal',
        'hidroxiVitaminaD',
        'biotinidasa',
        'tshSCREENING',
        'fenialanina',
        'tripsina',
        'galactosemia',
        'hidroxiprogesterona',
        'proteinasTotales',
        'albumina',
        'acidoUrico',
        'amilasa',
        'protTotales',
        'albuminasProt',
        'alfa1Globulina',
        'alfa2Globulina',
        'betaGlobulina',
        'gammaGlobulina',
        'relacion',
        'sodio',
        'potasio',
        'calcemia',
        'litio',
        'fosfatemia',
        'ferremia',
        'ferritina',
        'transferrina1',
        'transferrina2',
        'hba1c',
        'hdl',
        'ldl',
        'trigliceridos',
        'basal',
        'microalbuminuria',
        'ldh',
        'cpk',
        'antitiroperoxidasa',
        'material',
        'examenDirectoCelulas',
        'examenDirectoLeucocitos',
        'examenDirectoCClave',
        'gramFV',
        'score',
        'cultivo',
        'examenParasitologicoDFV',
        'examenMicologicoDFV',
        'observacionesFV',
        'antibiogramaS',
        'antibiogramaR',
        'testGraham',
        'parasitologicoSeriado',
        'parasitologicoSeriadoMacro',
        'parasitologicoSeriadoMicro',
        'materiaFecalL',
        'materiaFecalO',
        'indiceHOMA',
        'muestra',
        'exDirecto',
        'cultivoMico'
    ];

    protected $guarded = [];

    public function scopeName($query,$name){
        if (trim($name) != "") {
            $query->where('DNI','LIKE','%'.$name.'%');
        }
        
    }

    public function scopeInforme($query,$informe){
        if (trim($informe) != "") {
            $query->where('nombre','LIKE','%'.$informe.'%')
                  ->orwhere('apellido','LIKE','%'.$informe.'%')
                  ->orwhere('Informes_idInformes','LIKE',$informe);
        }
        
    }
        
}