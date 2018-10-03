<?php

namespace App\Http\Controllers;

use Request;
use App\User;
use App\Model\Dust;
use App\Model\Noise;
use App\Model\Vibration;
use App\Model\Movies;
use DB;
use ResponseManager;
use Excel;

class FrontController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function __construct() {
//        $this->middleware('auth');
//    }

    public function movies() {
        $movies = Movies::get()->toArray();
        return view('partials.admin.movies')->with(compact('movies'));
    }

    public function moviessingle($id) {
        $moviesdetails = Movies::where('slug', $id)->first();
        return view('partials.admin.moviesdetails')->with(compact('moviesdetails'));
    }

    public function tablefilter() {
        $input = Request::all();
        $ex = explode("-", $input['date']);

        $startdate = date("Y-m-d", strtotime(str_replace('/', '-', trim($ex[0]))));
        $enddate = date("Y-m-d", strtotime(str_replace('/', '-', trim($ex[1]))));


        if ($input['type'] == 'dust') {
            $data = Dust::whereRaw("datetime >= ? AND datetime <= ?", array($startdate . " 00:00:00", $enddate . " 23:59:59"))
                            ->where(function ($q) use ($input) {
                                if ($input['status'] == "true") {
                                    $q->where('pm', '>=', 60);
                                }
                                if ($input['monitor']) {
                                    $q->where('monitor_name', $input['monitor']);
                                }
                            })
                            ->orderBy('datetime')
                            ->get()->toArray();
        } else if ($input['type'] == 'noise') {
            $data = Noise::whereRaw("datetime >= ? AND datetime <= ?", array($startdate . " 00:00:00", $enddate . " 23:59:59"))
                            ->where(function ($q) use ($input) {
                                if ($input['status'] == "true") {
                                    $q->where('db', '>=', 60);
                                }
                                if ($input['monitor']) {
                                    $q->where('monitor_name', $input['monitor']);
                                }
                            })
                            ->orderBy('datetime')
                            ->get()->toArray();
        } else {
            $data = Vibration::whereRaw("datetime >= ? AND datetime <= ?", array($startdate . " 00:00:00", $enddate . " 23:59:59"))
                            ->where(function ($q) use ($input) {
                                if ($input['status'] == "true") {
                                    $q->where('mms', '>=', 1);
                                }
                                if ($input['monitor']) {
                                    $q->where('monitor_name', $input['monitor']);
                                }
                            })
                            ->orderBy('datetime')
                            ->get()->toArray();
        }

        if (count($data) > 0) {
            return Response()->json(ResponseManager::getResult($data, 10, 'Success'));
        } else {
            if ($input['status'] == "true") {
                $message = "There are no exceedences within date range";
            } else {
                $message = "There are no record found within date range";
            }
            return Response()->json(ResponseManager::getError('', 1, $message));
        }
    }

    public function dustchart() {
        $input = Request::all();
        $ex = explode("-", $input['date']);

        $startdate = date("Y-m-d", strtotime(str_replace('/', '-', trim($ex[0]))));
        $enddate = date("Y-m-d", strtotime(str_replace('/', '-', trim($ex[1]))));

        if ($input['status'] == "false") {

            if ($input['type'] == 5) {
                $data = Dust::orderBy('datetime')->whereRaw("datetime >= ? AND datetime <= ?", array($startdate . " 00:00:00", $enddate . " 23:59:59"))->get()->toArray();
//                $data = Dust::orderBy('datetime')->whereBetween('datetime', [$startdate, $enddate])->get();
            } else if ($input['type'] == 24) {
                $data = Dust::orderBy('datetime')->whereBetween('datetime', [$startdate, $enddate])->where('datetime', 'LIKE', '%:00:00')->get();
            } else {
                $dates = [$startdate];
                while ($startdate < $enddate) {
                    $startdate = strtotime("+7 day", strtotime($startdate));
                    $startdate = date("Y-m-d", $startdate);
                    $dates[] = $startdate;
                }
                $placeholder = implode(', ', array_fill(0, count($dates), '?'));
                $data = Dust::orderBy('datetime')->whereRaw('DATE(`datetime`) IN (' . $placeholder . ')', $dates)->get()->toArray();
            }
        } else {
            if ($input['type'] == 5) {
                $data = Dust::orderBy('datetime')->whereRaw("datetime >= ? AND datetime <= ?", array($startdate . " 00:00:00", $enddate . " 23:59:59"))->where('pm', '>=', 60)->get()->toArray();
            } else if ($input['type'] == 24) {
                $data = Dust::orderBy('datetime')->whereBetween('datetime', [$startdate, $enddate])->where('pm', '>=', 60)->where('datetime', 'LIKE', '%:00:00')->get()->toArray();
            } else {
                $dates = [$startdate];
                while ($startdate < $enddate) {
                    $startdate = strtotime("+7 day", strtotime($startdate));
                    $startdate = date("Y-m-d", $startdate);
                    $dates[] = $startdate;
                }
                $placeholder = implode(', ', array_fill(0, count($dates), '?'));
                $data = Dust::orderBy('datetime')->whereRaw('DATE(`datetime`) IN (' . $placeholder . ')', $dates)->where('pm', '>=', 60)->get()->toArray();
            }

//            print_r($data);exit;
        }

        if (count($data) > 0) {
            return Response()->json(ResponseManager::getResult($data, 10, 'Success'));
        } else {
            if ($input['status'] == "true") {
                $message = "There are no exceedences within date range";
            } else {
                $message = "There are no record found within date range";
            }
            return Response()->json(ResponseManager::getError('', 1, $message));
        }
    }

    public function noisechart() {
        $input = Request::all();
        $ex = explode("-", $input['date']);

        $stdate = trim($ex[0], " ");

        $startdate = date("Y-m-d", strtotime(str_replace('/', '-', trim($ex[0]))));
        $enddate = date("Y-m-d", strtotime(str_replace('/', '-', trim($ex[1]))));

        if ($input['status'] == "false") {
            if ($input['type'] == 5) {
                $data = Noise::orderBy('datetime')->whereRaw("datetime >= ? AND datetime <= ?", array($startdate . " 00:00:00", $enddate . " 23:59:59"))->get();
            } else if ($input['type'] == 24) {
                $data = Noise::orderBy('datetime')->whereBetween('datetime', [$startdate, $enddate])->where('datetime', 'LIKE', '%:00:00')->get();
            } else {
                $dates = [$startdate];
                while ($startdate < $enddate) {
                    $startdate = strtotime("+7 day", strtotime($startdate));
                    $startdate = date("Y-m-d", $startdate);
                    $dates[] = $startdate;
                }
                $placeholder = implode(', ', array_fill(0, count($dates), '?'));
                $data = Noise::orderBy('datetime')->whereRaw('DATE(`datetime`) IN (' . $placeholder . ')', $dates)->get();
            }
        } else {
            if ($input['type'] == 5) {
                $data = Noise::orderBy('datetime')->where('db', '>=', 60)->whereRaw("datetime >= ? AND datetime <= ?", array($startdate . " 00:00:00", $enddate . " 23:59:59"))->get();
            } else if ($input['type'] == 24) {
                $data = Noise::orderBy('datetime')->where('db', '>=', 60)->whereBetween('datetime', [$startdate, $enddate])->where('datetime', 'LIKE', '%:00:00')->get();
            } else {
                $dates = [$startdate];
                while ($startdate < $enddate) {
                    $startdate = strtotime("+7 day", strtotime($startdate));
                    $startdate = date("Y-m-d", $startdate);
                    $dates[] = $startdate;
                }
                $placeholder = implode(', ', array_fill(0, count($dates), '?'));
                $data = Noise::orderBy('datetime')->where('db', '>=', 60)->whereRaw('DATE(`datetime`) IN (' . $placeholder . ')', $dates)->get();
            }
        }
        if (count($data) > 0) {
            return Response()->json(ResponseManager::getResult($data, 10, 'Success'));
        } else {
            if ($input['status'] == "true") {
                $message = "There are no exceedences within date range";
            } else {
                $message = "There are no record found within date range";
            }
            return Response()->json(ResponseManager::getError('', 1, $message));
        }
    }

    public function vibrationchart() {
        $input = Request::all();
        $ex = explode("-", $input['date']);

        $stdate = trim($ex[0], " ");
        $startdate = date("Y-m-d", strtotime(str_replace('/', '-', trim($ex[0]))));
        $enddate = date("Y-m-d", strtotime(str_replace('/', '-', trim($ex[1]))));


//        $startdate = date("Y-m-d", strtotime(trim($ex[0], " ")));
//        $enddate = date("Y-m-d", strtotime(trim($ex[1], " ")));
        if ($input['status'] == "false") {
            if ($input['type'] == 5) {
                $data = Vibration::orderBy('datetime')->whereRaw("datetime >= ? AND datetime <= ?", array($startdate . " 00:00:00", $enddate . " 23:59:59"))->get();
            } else if ($input['type'] == 24) {
                $data = Vibration::orderBy('datetime')->whereBetween('datetime', [$startdate, $enddate])->where('datetime', 'LIKE', '%:00:00')->get();
            } else {
                $dates = [$startdate];
                while ($startdate < $enddate) {
                    $startdate = strtotime("+7 day", strtotime($startdate));
                    $startdate = date("Y-m-d", $startdate);
                    $dates[] = $startdate;
                }
                $placeholder = implode(', ', array_fill(0, count($dates), '?'));
                $data = Vibration::orderBy('datetime')->whereRaw('DATE(`datetime`) IN (' . $placeholder . ')', $dates)->get();
            }
        } else {
            if ($input['type'] == 5) {
                $data = Vibration::orderBy('datetime')->where('mms', '>=', 1)->whereRaw("datetime >= ? AND datetime <= ?", array($startdate . " 00:00:00", $enddate . " 23:59:59"))->get();
            } else if ($input['type'] == 24) {
                $data = Vibration::orderBy('datetime')->where('mms', '>=', 1)->whereBetween('datetime', [$startdate, $enddate])->where('datetime', 'LIKE', '%:00:00')->get();
            } else {
                $dates = [$startdate];
                while ($startdate < $enddate) {
                    $startdate = strtotime("+7 day", strtotime($startdate));
                    $startdate = date("Y-m-d", $startdate);
                    $dates[] = $startdate;
                }
                $placeholder = implode(', ', array_fill(0, count($dates), '?'));
                $data = Vibration::orderBy('datetime')->where('mms', '>=', 1)->whereRaw('DATE(`datetime`) IN (' . $placeholder . ')', $dates)->get();
            }
        }

        if (count($data) > 0) {
            return Response()->json(ResponseManager::getResult($data, 10, 'Success'));
        } else {
            if ($input['status'] == "true") {
                $message = "There are no exceedences within date range";
            } else {
                $message = "There are no record found within date range";
            }
            return Response()->json(ResponseManager::getError('', 1, $message));
        }
//        return view('partials.admin.dustlinechart')->with(compact('dust'));
    }

    public function noice() {
        $Noise = Noise::get();
        $Noisemonitor = Noise::groupBy('monitor_name')->get()->toArray();
        $Noisearray = [];
        foreach ($Noisemonitor as $val) {
            $datewise = Noise::select('monitor_name', DB::raw('SUM(db) as db'), 'datetime')->where('monitor_name', $val['monitor_name'])->groupBy(DB::raw('Date(datetime)'))->get()->toArray();
            $result['monitor_name'] = $val['monitor_name'];
            $result['monitor'] = $datewise;
            $dustarray[] = $result;
        }
        return view('partials.admin.Noise')->with(compact('Noise', 'Noisearray'));
    }

    public function dusttable() {
        $dust = Dust::orderBy('datetime')->whereBetween('datetime', ['2018-08-30 02:00:00', '2018-08-30 17:00:00'])->get();
        $monitors = Location::where('monitor_name', 'like', '%Dust%')->pluck('monitor_name')->toArray();
        return view('partials.admin.dusttable')->with(compact('dust', 'monitors'));
    }

    public function dustmap() {
        $location = Location::where('monitor_name', 'like', '%Dust%')->pluck('monitor_name');
        return view('partials.admin.dustmap')->with(compact('location'));
    }

    public function dustmaplive() {
        $location = Location::where('monitor_name', 'like', '%Dust%')->get()->toArray();
        $i = 0;
        $result = [];
        foreach ($location as $val) {
            $radius = rand(1, 9);
            $radius = $radius * 10;
            $color = 'a0';
            if ($radius >= 60) {
                $color = 'a1';
            }
            $data = [
                "type" => "Feature",
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [$val["longitude"], $val["latitude"]],
                ],
                "properties" => [
                    "bgcolor" => $color,
                    "date" => date("dS F Y h:i:sa"),
                    "title" => $val["monitor_name"],
                    "monitor" => str_replace('Dust_', '', $val["monitor_name"]),
                    "radius" => $radius
                ]
            ];
//            $data = '"properties": {"bgcolor": "a" + ' . $i . ',"date": "' . $val['dustrelation']["datetime"] . '","title": "' . $val["monitor_name"] . '","radius": ' . rand(10, 30) . '}}';
            $i++;
            $result[] = $data;
        }
        $map['type'] = "FeatureCollection";
        $map['features'] = $result;
        return response()->json($map);
    }

    public function noisemaplive() {
        $location = Location::where('monitor_name', 'like', '%Noise%')->get()->toArray();
        $i = 0;
        $result = [];
        foreach ($location as $val) {
            $radius = rand(1, 9);
            $radius = $radius * 10;
            $color = 'a0';
            if ($radius >= 55) {
                $color = 'a2';
            }
            if ($radius >= 60) {
                $color = 'a1';
            }
            $data = [
                "type" => "Feature",
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [$val["longitude"], $val["latitude"]],
                ],
                "properties" => [
                    "bgcolor" => $color,
                    "date" => date("dS F Y h:i:sa"),
                    "title" => $val["monitor_name"],
                    "monitor" => str_replace('Noise_', '', $val["monitor_name"]),
                    "radius" => $radius
                ]
            ];
            $i++;
            $result[] = $data;
        }
        $map['type'] = "FeatureCollection";
        $map['features'] = $result;
        return response()->json($map);
    }

    public function vibrationmaplive() {
        $location = Location::where('monitor_name', 'like', '%Vibration%')->get()->toArray();
        $i = 0;
        $result = [];
        foreach ($location as $val) {

            $radius = rand(2, 30);
            $color = 'a0';
            if ($radius >= 20) {
                $color = 'a1';
            }
            $data = [
                "type" => "Feature",
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [$val["longitude"], $val["latitude"]],
                ],
                "properties" => [
                    "bgcolor" => $color,
                    "date" => date("dS F Y h:i:sa"),
                    "title" => $val["monitor_name"],
                    "monitor" => str_replace('Vibration_', '', $val["monitor_name"]),
                    "radius" => $radius
                ]
            ];
            $i++;
            $result[] = $data;
        }
        $map['type'] = "FeatureCollection";
        $map['features'] = $result;
        return response()->json($map);
    }

    public function noisemap() {
        $location = Location::where('monitor_name', 'like', '%Noise%')->pluck('monitor_name');
        return view('partials.admin.noisemap')->with(compact('location'));
    }

    public function vibrationmap() {
        $location = Location::where('monitor_name', 'like', '%Vibration%')->pluck('monitor_name');
        return view('partials.admin.vibrationmap')->with(compact('location'));
    }

    public function dustlinechart() {
        $dust = Dust::orderBy('datetime')->whereBetween('datetime', ['2018-06-30 02:00:00', '2018-06-30 17:00:00'])->get();
        return view('partials.admin.dustlinechart')->with(compact('dust'));
    }

    public function dustbarchart() {
        $dust = Dust::orderBy('datetime')->whereBetween('datetime', ['2018-08-30 02:00:00', '2018-08-30 17:00:00'])->get();
        return view('partials.admin.dustbarchart')->with(compact('dust'));
    }

    public function noisetable() {
        $noise = Noise::orderBy('datetime')->whereBetween('datetime', ['2018-08-30 02:00:00', '2018-08-30 17:00:00'])->get();
        $monitors = Location::where('monitor_name', 'like', '%Noise%')->pluck('monitor_name')->toArray();
        return view('partials.admin.noisetable')->with(compact('noise', 'monitors'));
    }

    public function noiselinechart() {
        $noise = Noise::orderBy('datetime')->whereBetween('datetime', ['2018-08-30 02:00:00', '2018-08-30 17:00:00'])->get();
        return view('partials.admin.noiselinechart')->with(compact('noise'));
    }

    public function noisebarchart() {
        $noise = Noise::orderBy('datetime')->whereBetween('datetime', ['2018-08-30 02:00:00', '2018-08-30 17:00:00'])->get();
        return view('partials.admin.noisebarchart')->with(compact('noise', 'data'));
    }

    public function vibrationtable() {
        $vibration = Vibration::orderBy('datetime')->get();
        $monitors = Location::where('monitor_name', 'like', '%Vibration%')->pluck('monitor_name')->toArray();
        return view('partials.admin.vibrationtable')->with(compact('vibration', 'monitors'));
    }

    public function vibrationlinechart() {
        $vibration = Vibration::orderBy('datetime')->get();

        return view('partials.admin.vibrationlinechart')->with(compact('vibration'));
    }

    public function vibrationbarchart() {
        $vibration = Vibration::orderBy('datetime')->get();
        return view('partials.admin.vibrationbarchart')->with(compact('vibration'));
    }

    public function vibration() {
        $vibration = Vibration::get();
        return view('partials.admin.vibration')->with(compact('vibration'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
//        return view('partials.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importexcel() {
        $input = Request::all();
        Excel::load($input['file'], function($reader) {
            $reader->each(function($sheet) {
                $sheetTitle = $sheet->getTitle();
                if ($sheetTitle == 'Dust') {
                    Dust::all()->delete();
                    $results = Dust::insert($sheet->toArray());
                } else if ($sheetTitle == 'Noise') {
                    Noise::all()->delete();
                    $result = Noise::insert($sheet->toArray());
                } else if ($sheetTitle == 'Vibration') {
                    Noise::all()->delete();
                    $result = Vibration::insert($sheet->toArray());
                } else if ($sheetTitle == 'Monitor locations') {
                    Vibration::all()->delete();
                    $result = Vibration::insert($sheet->toArray());
                }
            });

            return redirect()->route('/')->with('message', 'Successfully saved');
        });
    }

    public function store(Request $request) {
        $input = Request::all();
        print_r($input);
        exit;
        Excel::load($input['file'], function($reader) {

            $results = $reader->get()->toArray();
            $result = Dust::insert($results[0]);
            $result = Noise::insert($results[1]);
            $result = Vibration::insert($results[2]);
            // reader methods

            return redirect()->route('users.index')->with('message', 'Successfully saved');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::find();
        return view('users.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::find($id);
        if ($user) {
            return view('users.index', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = Request::all();
        $result = User::find($id)->update($input);
        if ($result) {
            return redirect()->route('users.index')
                            ->with('success', 'Item updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $result = User::find($id)->delete();
        if ($result) {
            return redirect()->route('users.index')
                            ->with('success', 'Item updated successfully');
        }
    }

}
