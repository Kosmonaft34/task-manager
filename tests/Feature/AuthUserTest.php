<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthUserTest extends TestCase
{
   public function test_page_login()
   {
       //Заходим на страницу с авторизацией пользователя
      $response = $this->get('register/authorization');

       //Проверяем, что запрос работает
       $response -> assertOk();
   }
   public function test_pageRegister(){
       //Заходим на страницу с авторизацией пользователя
       $response = $this->get('/register');

       //Проверяем, что запрос работает
       $response -> assertOk();
   }
}
