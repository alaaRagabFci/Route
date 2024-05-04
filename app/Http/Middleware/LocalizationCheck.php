<?php

namespace App\Http\Middleware;

use Closure;

class LocalizationCheck
{
    protected $acceptableLanguages = ['ar', "en"];
    protected $defaultLanguage = 'en';

    /**
     * Handle an incoming request and set the application locale based on accept-language key in the header, otherwise arabic.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       $locale = $this->getAcceptLanguageOrDefault($request);
       \App::setlocale($locale);
       return $next($request);
    }

    protected function getAcceptLanguageOrDefault($request){
        if(in_array($request->header('Accept-Language'), $this->acceptableLanguages)){
            return $request->header('Accept-Language');
        }else{
            return $this->defaultLanguage;
        }
    }
}
