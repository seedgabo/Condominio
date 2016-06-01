<?php
class Eventos extends Eloquent {

    protected $table ="eventos";
    protected $fillable = array('razon','fecha_ini','tiempo_ini','fecha_fin','tiempo_fin','user_id','persona','areas');

    public function user(){
        return $this->hasOne('User');
    }
}


Eventos::observe(new EnentoObserver);



class EventoObserver{

    public function created($model){
        if (Config::get('var.push',false)){

            $dispositivos = Dispositivo::active()->eventos()->get();
            $disp = [];

            foreach ($dispositivos as $dispositivo) {
                $disp[]= PushNotification::Device($dispositivo->token);
            }

            $devices = PushNotification::DeviceCollection($disp);

            $message = PushNotification::Message($model->user->nombre . ' ha agregado un nuevo Evento',[
                'badge' => 1,
                'image' => 'www/logo.png',
                'title' => 'Nueva Noticia'
            ]);

            $collection = PushNotification::app('android')
            ->to($devices)
            ->send($message);

            // return $collection;
        }
    }


}
