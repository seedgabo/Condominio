<?php
class Eventos extends Eloquent {

    protected $table ="eventos";
    protected $fillable = array('razon','fecha_ini','tiempo_ini','fecha_fin','tiempo_fin','user_id','persona','areas');

    public function user(){
        return $this->belongsTo('User');
    }

    public function  setAreasAttribute($value){
        $this->attributes['areas'] = json_encode($value);
    }

    public function  getAreasAttribute($value){
        return   json_decode($value);
    }

    public function Areas(){
        return Areas::whereIn('id', $this->areas)->get();
    }
}


Eventos::observe(new EventoObserver);



class EventoObserver{

    public function created($model){
        if (Config::get('var.push',false)){

            $dispositivos = Dispositivo::active()->eventos()->get();
            $disp = [];

            foreach ($dispositivos as $dispositivo) {
                $disp[]= PushNotification::Device($dispositivo->token);
            }

            $devices = PushNotification::DeviceCollection($disp);

            $actions = [];
            $actions[0] = new stdClass();
            $actions[0]->icon = 'eye';
            $actions[0]->title = 'ver';
            $actions[0]->callback = 'mycallback';
            $devices = PushNotification::DeviceCollection($disp);
            $message = PushNotification::Message($model->user->nombre . ' ha agregado un nuevo evento',[
                'badge' => 1,
                'image' => 'www/logo.png',
                'soundname' => 'alert',
                'title' => 'Nueva Evento',
                "ledColor" => [0, 146, 234, 255],
                'actions' => $actions
            ]);

            $collection = PushNotification::app('android')
            ->to($devices)
            ->send($message);

        }
    }


}
