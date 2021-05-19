<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Acaronlex\LaravelCalendar\Calendar;
use App\Http\Controllers\FullCalenderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Calendar controller route
Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);

// Login. Gets user token from Discord, and redirects to Dashboard
Route::get('/login', function(Request $request) {
    $client_id = ""; // YOUR DISCORD CLIENT ID
    $client_secret = ''; // YOUR DISCORD CLIENT SECRET CODE

    // Get Discord user token1
    $code = $request->get('code', 1);
    error_log($code);
    // Get Discord user token2
    $tokenCall = Http::asForm()->withHeaders([
        'Content-Type' => 'application/x-www-form-urlencoded'
    ])->post('https://discord.com/api/oauth2/token', [
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => "authorization_code",
        'redirect_uri' => 'http://localhost:8000/login',
    ]);    
    try {
        $token = (json_decode($tokenCall, true))["access_token"];
        $token2 = (json_decode($tokenCall, true))["refresh_token"];
        // Get Discord user info
        $res = Http::withToken($token)->get('http://discordapp.com/api/users/@me');
        $id = (json_decode($res, true))["id"];
        $username = (json_decode($res, true))["username"];
        $avatar = (json_decode($res, true))["avatar"];
        $discriminator = (json_decode($res, true))["discriminator"];
    
        // Save user token into DB
        $update = DB::table('users')->upsert([
            ['id' => $id, 'token' => $token, 'remember_token' => $token2, 'updated_at' => DB::raw('now()')]],
            ['id'], ['token', 'remember_token', 'updated_at']
        );
    
        // All transactions done. Saving on session...
        session_start();
        $_SESSION["Dis_id"]=$id;
        $_SESSION["user"]=$username;
        $_SESSION["avatar"]=$avatar;
        $_SESSION["disc"]=$discriminator;
        return redirect('/dashboard');
    } catch (Exception $e) {
        return redirect('/');
    }
    
});

// Dashboard. Shows all user's servers.
Route::get('/dashboard', function() {
    session_start();
    if (isset($_SESSION["Dis_id"])){ // Check if user did already login
        $token = DB::table('users')->select('token')->where('id', $_SESSION["Dis_id"])->get();
        $servers = json_decode(Http::withToken($token[0]->token)->get('https://discord.com/api/users/@me/guilds'), true);
        // Sort response, servers with most permissions first (owned, admin, moderator, etc...)
        usort($servers, function($a, $b){
            return $b['permissions'] <=> $a['permissions'];
        });
        return view('dashboard',['servers'=>$servers    ]);
    } else {
        return redirect('/');
    }
});

// Server dashboard. Shows all server events.
Route::get('/dashboard/{id}', function(Request $request){
    session_start();
    if (isset($_SESSION["Dis_id"])) {
        $events = [];
        $server = $request->route('id');

        // Select all events, depending if are from DM or server.
        if ($server == 'dm') {
            $DBevents = DB::table('events')->select('*')->where('user', $_SESSION['Dis_id'])->where('type', 'dm')->get(); // DM events
        } else {
            $DBevents = DB::table('events')->select('*')->where('server_id', $server)->get(); // Server events
        }

        // Create events array
        foreach($DBevents as $event) {
            $events[] = Calendar::event(
                $event->name, // Event name
                false, // Not a full day event.
                $event->eventDate, // starting date
                $event->eventDate, // End date
                $event->id, // Event id
                [
                    'editable' => true,
                ]
            );
        }
        // Add events to calendar
        $calendar = new Calendar();
            $calendar->addEvents($events)
            ->setOptions([
                'locale' => 'es',
                'firstDay' => 0,
                'displayEventTime' => true,
                'selectable' => true,
                'initialView' => 'dayGridMonth',
                'headerToolbar' => [
                    'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
                ],
                'buttonText' => [
                    'today' => 'Hoy',
                    'month' => 'Mes',
                    'week'  => 'Semana',
                    'day'   => 'Día',
                    'list'  => 'lista'
                ]
            ]);
            $calendar->setId('1');
            $calendar->setCallbacks([
                'select' => 'function(selectionInfo){}',
                'eventClick' => 'function(event){}'
            ]);
        return view('calendar', compact('calendar'));
    } else {
        return redirect('/');
    }
});

// About page.
Route::get('/about', function () {
    session_start();
    return view('about');
});

// Docs page.
Route::get('/docs', function () {
    session_start();
    return view('docs');
});


// Landing page.
Route::get('/', function () {
    session_start();
    return view('welcome');
});

// Logout page.
Route::get('/logout', function () {
    session_start();
    unset($_SESSION["Dis_id"]);
    unset($_SESSION["user"]);
    unset($_SESSION["avatar"]);
    unset($_SESSION["disc"]);

    return redirect('/');
});
