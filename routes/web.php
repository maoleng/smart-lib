<?php

use App\Livewire\SiteComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', SiteComponent::class)->name('index');
