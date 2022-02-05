<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h2 dir="auto"><a id="user-content-getting-started" class="anchor" aria-hidden="true" href="#getting-started"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.775 3.275a.75.75 0 001.06 1.06l1.25-1.25a2 2 0 112.83 2.83l-2.5 2.5a2 2 0 01-2.83 0 .75.75 0 00-1.06 1.06 3.5 3.5 0 004.95 0l2.5-2.5a3.5 3.5 0 00-4.95-4.95l-1.25 1.25zm-4.69 9.64a2 2 0 010-2.83l2.5-2.5a2 2 0 012.83 0 .75.75 0 001.06-1.06 3.5 3.5 0 00-4.95 0l-2.5 2.5a3.5 3.5 0 004.95 4.95l1.25-1.25a.75.75 0 00-1.06-1.06l-1.25 1.25a2 2 0 01-2.83 0z"></path></svg></a>GETTING STARTED</h2>

<p dir="auto">If you do not have <a href="http://getcomposer.org/" rel="nofollow">Composer</a>, you can install it by following the instructions
at <a href="http://getcomposer.org/doc/00-intro.md#installation-nix" rel="nofollow">getcomposer.org</a>.</p>
<p dir="auto">You can then install the application using the following command:</p>
<div class="snippet-clipboard-content position-relative overflow-auto" data-snippet-clipboard-copy-content="https://github.com/rhko/SayarahTaskLaravel"><pre>
<code>
1- clone the repo
    git clone https://github.com/rhko/SayarahTaskLaravel
2- cd SayarahTaskLaravel
3- Install all the dependencies using composer
    composer install
4- Copy the example env file
    cp .env.example1 .env
5- Generate a new application key
    php artisan key:generate
6- Run the local development server
    php artisan serve
7- (Optional) I provided sample client_secret.json file in the project for test, if you need to provide your own google app you need to go <a href="https://console.developers.google.com" rel="nofollow">google developer console</a> and register your app then make callback url looks like <a href="http://localhost:8000/drive/callback" rel="nofollow">http://localhost:8000/drive/callback</a> then save file as client_secret.json and replace the original file in project root directory
</code>
</pre>
</div>
