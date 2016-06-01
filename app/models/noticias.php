<?php
class Noticias extends Eloquent {

    protected $table ="noticias";
    
    protected $fillable =array('titulo','contenido','persona', 'user_id','fecha','media');

    public function user(){
        return $this->belongsTo('User');
    }
}



Noticias::observe(new NoticiaObserver);



class NoticiaObserver{

    public function created($model){
        if (Config::get('var.push',false)){

            $dispositivos = Dispositivo::active()->mensajes()->get();
            $disp = [];

            foreach ($dispositivos as $dispositivo) {
                $disp[]= PushNotification::Device($dispositivo->token);
            }

            $devices = PushNotification::DeviceCollection($disp);
            $message = PushNotification::Message($model->user->nombre . ' ha agregado una nueva noticia',[
                'badge' => 1,
                'image' => 'www/logo.png',
                'title' => 'Nueva Noticia'
            ]);

            $collection = PushNotification::app('android')
            ->to($devices)
            ->send($message);

            // return $collection;
        }
        Session::flash('status', 'green');
    }


}
