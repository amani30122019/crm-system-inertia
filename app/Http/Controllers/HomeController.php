<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;


class HomeController extends Controller
{
    public function index()
    {
        return inertia('Home/Index');
    }
    public function reportsIndex()
    {
        return inertia('Home/Reports');
    }
    public function reportsUsers()
    {
        $users = User::all();
        $pdf = Pdf::loadView('reports.usersReport', compact('users'))->setPaper('a4', 'portrait')->setWarnings(false)->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']); 
        return $pdf->stream('Users-Reports-'.time().'.pdf');
    }
    public function reportsPosts()
    {
        $posts = Post::all();
        $pdf = Pdf::loadView('reports.postsReport', compact('posts'))->setPaper('a4', 'portrait')->setWarnings(false)->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('Posts-Reports-'.time().'.pdf');
    }
}