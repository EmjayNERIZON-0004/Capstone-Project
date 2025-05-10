<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
class LoginSessionMw
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      // Check if the user is authenticated
      if (session('account_type')) {
        // Check user account type and redirect accordingly
      
        $accountType = session('account_type');
    
        if ($accountType === 'admin') { 
            return redirect('AdminDashboard');
        } elseif ($accountType === 'section') { 
            return redirect()->route('section_dashboard');
        } elseif ($accountType === 'office') { 
            return  redirect()->route('dashboard_with_score'); 
        }
    }

    // If user is not authenticated, continue with the request (i.e., show the login page)
    return $next($request);
    }
}
