@include('layouts.header-admin')
@include('layouts.navbar-admin')

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Dokumen Audit</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{$countDocs}}
                      <span class="text-success text-sm font-weight-bolder">Dokumen</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Dokumen Yang Belum Dilengkapi</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{$countDocsUnsend}}
                      <span class="text-warning text-sm font-weight-bolder">Dokumen</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Temuan Audit</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{$countTemuan}}
                      <span class="text-warning text-sm font-weight-bolder">Temuan</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Temuan Audit Yang Belum Dilengkapi</p>
                    <h5 class="font-weight-bolder mb-0">
                        {{$countEvalUnsend}}
                      <span class="text-danger text-sm font-weight-bolder">Temuan</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Trafic Temuan Audit</h6>
              <p class="text-sm">
                <i class="fa fa-check text-success" aria-hidden="true"></i>
                <span class="font-weight-bold ms-1"> {{$totalTemuan}} </span> Total Temuan
              </p>
            </div>
            <div class="card-body p-3">
              <div class="chart mb-4">
                <canvas id="chart-line" height="250" width="350"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row my-4">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Rangking Point</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    Anda Berada Diurutan ke  <span class="font-weight-bold ms-1">{{$userRanking}}</span> dari {{$lembagaScores->count()}} Lembaga
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ranking</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Lembaga</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $colors = ['bg-gradient-info', 'bg-gradient-success', 'bg-gradient-danger', 'bg-gradient-warning', 'bg-gradient-primary'];
                            @endphp
                            @foreach($lembagaScores as $index => $lembaga)
                                @php
                                    $isLoggedInInstitution = ($lembaga['id_lembaga'] === $getLembaga);
                                    $raisedClass = $isLoggedInInstitution ? 'raised-text' : '';
                                @endphp
                                <tr class="{{ $raisedClass }}">
                                    <td class="text-center">
                                        <div class="d-flex px-2 py-1 text-center">
                                            <div class="d-flex flex-column justify-content-center text-center">
                                                <p class="mb-0 text-sm ms-4 text-center {{ $raisedClass }}">{{ $index + 1 }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm {{ $raisedClass }}">{{ $lembaga['nama_lembaga'] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <div class="progress-wrapper w-75 mx-auto">
                                            <div class="progress-info">
                                                <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold {{ $raisedClass }}">{{ $lembaga['total_score'] }}</span>
                                                </div>
                                            </div>
                                            <div class="progress align-items-center">
                                                <div class="progress-bar {{ $colors[$index % count($colors)] }}" role="progressbar" style="width: {{ $maxScore ? ($lembaga['total_score'] / $maxScore * 100) : 0 }}%" aria-valuenow="{{ $lembaga['total_score'] }}" aria-valuemin="0" aria-valuemax="{{ $maxScore }}"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>

<script>
        document.addEventListener('DOMContentLoaded', (event) => {
        var ctx2 = document.getElementById("chart-line").getContext("2d");

        // Data from server
        var lembagaScores = <?php echo json_encode($radar)?>;

        // Extract labels and data for each status
        var labels = ['Major', 'Minor', 'Close'];
        var data = [lembagaScores.major, lembagaScores.minor, lembagaScores.close];

        const pieData = {
            labels: labels,
            datasets: [
                {
                    label: 'Scores',
                    backgroundColor: [
                        'rgba(203,12,159,0.2)',
                        'rgba(20,23,39,0.2)',
                        'rgba(19, 162, 164, 0.2)'
                    ],
                    borderColor: [
                        '#cb0c9f',
                        '#3A416F',
                        '#19a2a4'
                    ],
                    data: data
                }
            ]
        };

        const config = {
            type: 'pie',
            data: pieData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                padding: {
                    bottom: 10, // Adjust top padding to give space between the chart and the legend
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                    }
                },
            },
        };

        new Chart(ctx2, config);
});

</script>

<style>
    .raised-text {
        position: relative;
        font-weight: bold;
        z-index: 1;
        justify-content: center;
        align-items: center;
    }

    .raised-text::after {
        content: '';
        position: absolute;
        top: 1px;
        left: 1px;
        width: 100%;
        height: 90%;
        z-index: -1;
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }
</style>

@include('layouts.footer-admin')
@include('layouts.script-admin')
