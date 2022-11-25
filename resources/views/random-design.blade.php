<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 5 Website Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <style>
        .imag-container {
            height: 200px;
        }

        .imag-container img {
            height: inherit;
            object-fit: cover;
            object-position: center;
            width: 100%;
        }

        .square-circle, .square-smaller-circle {
            height: 40px;
            width: 40px;
        }

        .square-smallest-circle{
            height: 25px;
            width: 25px;
        }

        @media (max-width: 992px) {
            .imag-container {
                height: 100px;
            }

            .square-smaller-circle {
                height: 29px;
                width: 29px;
            }

            p, .font-sm {
                font-size: 12px;
            }
        } 
    </style>
    <div class="container my-4">
        <h3 class="h3 text-center mb-5">
            Design needed
        </h3>

        <div class="card mb-3">
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-3">
                        <div class="imag-container border border-dark mb-3">
                            <img src="https://wallpaperset.com/w/full/1/a/2/434195.jpg" alt="" class="img-fluid">
                            {{-- <img src="https://img.freepik.com/free-vector/nature-scene-with-river-hills-forest-mountain-landscape-flat-cartoon-style-illustration_191095-260.jpg?w=2000" alt="" class="img-fluid"> --}}
                        </div>
                    </div>
                    <div class="col-5 d-flex justify-content-start align-items-center">
                        <div>
                            <p class="fw-bold">M - Special</p>
                            
                            <p class="fw-light"><?php echo date("jS M, Y | h:ia") ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white p-3 text-center">
                                <h5 class="h5">Countdown to Next Game Draw</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="border border-dark p-2 bg-light">
                                            <p class="mb-0">00</p>
                                            <p class="mb-1">days</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="border border-dark p-2 bg-light">
                                            <p class="mb-0">04</p>
                                            <p class="mb-1">hrs</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="border border-dark p-2 bg-light">
                                            <p class="mb-0">42</p>
                                            <p class="mb-1">mins</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="border border-dark p-2 bg-light">
                                            <p class="mb-0">20</p>
                                            <p class="mb-1">secs</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="row">
                <?php for($i = 0; $i < 3; $i++) { ?>
                <div class="col-lg-4">
                    <div class="card-body bg-light border mb-1">
                        <div class="d-flex justify-content-center">
                            <div class="text-center">
                                <p class="fw-bolder mb-2">M - National</p>
                                <p class="fw-light mb-2">Draw Time: <?php echo date("jS M, Y | h:ia") ?> </p>
                                <p class="small fw-light mb-2"><small class="small">Some text here and there</small></p>
                                <div class="row justify-content-center">
                                    <div class="col-2">
                                        <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-circle">
                                            <span>1</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="border bg-primary text-white rounded-circle d-flex justify-content-center align-items-center square-circle">
                                            <span>2</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-circle">
                                            <span>3</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="border bg-primary text-white rounded-circle d-flex justify-content-center align-items-center square-circle">
                                            <span>4</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-circle">
                                            <span>5</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="#" class="btn btn-primary">
                                        View more
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-3">
                        <div class="imag-container border border-dark mb-3">
                            {{-- <img src="https://wallpaperset.com/w/full/1/a/2/434195.jpg" alt="" class="img-fluid"> --}}
                            <img src="https://img.freepik.com/free-vector/nature-scene-with-river-hills-forest-mountain-landscape-flat-cartoon-style-illustration_191095-260.jpg?w=2000" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        <div>
                            <p class="fw-bold mb-0">M - Special</p>
                            
                            <p class="fw-light"><?php echo date("jS M, Y | h:ia") ?></p>

                            <div class="row">
                                <div class="col-2">
                                    <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                        <span>41</span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                        <span>32</span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                        <span>63</span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                        <span>74</span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                        <span>55</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div>
                            <p class="fw-bold mb-4">Option A</p>
                            
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="button">
                                    Play Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-primary p-3">
                            <tr class="text-center">
                                <th>Operator</th>
                                <th>Game</th>
                                <th>Date</th>
                                <th>Result</th>
                                <th>Option A</th>
                                <th>Option B</th>
                                <th>Option C</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i=0; $i<2; $i++) { ?>
                                <tr class="text-center">
                                    <td>Text Here</td>
                                    <td>Another Text</td>
                                    <td><?php echo date("jS M, Y") ?></td>
                                    <td>
                                        <div class="row px-3">
                                            <div class="col-12 mx-auto">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>21</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>32</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>43</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>54</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>65</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row px-3">
                                            <div class="col-12 mx-auto">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="border bg-primary text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>51</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-default rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>92</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-primary text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>13</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-default rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>34</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-primary text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>75</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row px-3">
                                            <div class="col-12 mx-auto">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="border bg-default rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>81</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-primary text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>62</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-default rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>33</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-primary text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>44</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-default rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row px-3">
                                            <div class="col-12 mx-auto">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="border bg-primary text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>50</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-default rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>25</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-primary text-white rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>43</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-default rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>48</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="border bg-default rounded-circle d-flex justify-content-center align-items-center square-smallest-circle">
                                                            <span>95</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>