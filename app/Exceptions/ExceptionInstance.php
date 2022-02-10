<?php
 
namespace App\Exceptions;
 
class ExceptionInstance
{

    /* Exceptions Instance Of Not Validation Exception */
    public static function ofNotValidation($e)
    {
        return ! $e instanceof \Illuminate\Validation\ValidationException;
    }

   /* Exceptions Instance Of 403 */
    public static function of403($e)
    {
        return $e instanceof \Illuminate\Auth\Access\AuthorizationException;
    }

   /* Exceptions Instance Of 404 */
    public static function of404($e)
    {
        return (
            $e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException ||
            $e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException ||
            $e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
        );
    }

    /* Exceptions Instance Of 500 */
    public static function of500($e)
    {
        return $e instanceof \Illuminate\Database\QueryException;
    }    

    /* Exceptions Instance Of Not Custom Exception */
    public static function ofNotCustom($e)
    {//422 entidad no procesable.

        if ( ExceptionInstance::of403($e) ) 
            return [ "msg" => "Esta acción no está autorizada.", "cod" => 403 ];
        else if ( ExceptionInstance::of404($e) )
            return [ "msg" => "Página no encontrada.", "cod" => 404 ];
        else if ( ExceptionInstance::of500($e) )
            return [ "msg" => "Error interno del servidor.", "cod" => 500 ];
        else
            return [ "msg" => "Error desconocido.", "cod" => $e->getStatusCode() ];
    }

    /* Exceptions Instance Of Custom Exception */
    public static function ofCustom($e)
    {
        return $e instanceof \App\Exceptions\CustomException;  
    }

}
