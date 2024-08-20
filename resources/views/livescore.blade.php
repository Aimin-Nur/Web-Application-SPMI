@include('layouts.header-admin')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                  <div class="row">
                    <div class="col-8">
                        <img src="{{asset('creative')}}/assets/img/spmi.png" class="img-fluid navbar-brand">
                    </div>
                  </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
              <div class="card">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Lembaga</p>
                        <h5 class="font-weight-bolder mb-0">
                         {{$countLembaga}}
                          <span class="text-success text-sm font-weight-bolder">Biro</span>
                        </h5>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="fa fa-sitemap text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
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
                        <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4 mt-4">
              <div class="card">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Temuan Audit</p>
                        <h5 class="font-weight-bolder mb-0">
                         {{$countTemuan}}
                          <span class="text-success text-sm font-weight-bolder">Temuan</span>
                        </h5>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="fa fa-search-minus text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4 mt-4">
              <div class="card">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Auditor</p>
                        <h5 class="font-weight-bolder mb-0">
                         {{$countAuditor}}
                          <span class="text-success text-sm font-weight-bolder">Auditor</span>
                        </h5>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="fa fa-user-secret text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4 mt-4">
              <div class="card">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Laporan Audit</p>
                        <h5 class="font-weight-bolder mb-0">
                         {{$countLaporan}}
                          <span class="text-success text-sm font-weight-bolder">Laporan Audit</span>
                        </h5>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="fa fa-file text-lg opacity-10" aria-hidden="true"></i>
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
                <span class="font-weight-bold ms-1"> {{$lembagaScores->count()}} </span> Lembaga Terdaftar
              </p>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" height="600" width="500"></canvas>
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
                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">Skor Temuan</span> Audit
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                  </div>
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
                                <tr>
                                    <td class="text-center">
                                        <div class="d-flex px-2 py-1 text-center">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <p class="mb-0 text-sm text-center ms-4 text-dark">{{ $index + 1 }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $lembaga['nama_lembaga'] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <div class="progress-wrapper w-35 mx-auto">
                                            <div class="progress-info mb-1">
                                                <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold text-dark">{{ $lembaga['total_score'] }}</span>
                                                </div>
                                            </div>
                                            <div class="progress">
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

      <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var lembagaScores = <?php echo json_encode($radar)?>;

            var labels = lembagaScores.map(function (item) { return item.nama_lembaga; });
            var averageData = lembagaScores.map(function (item) { return item.average; });
            var poorData = lembagaScores.map(function (item) { return item.poor; });
            var goodData = lembagaScores.map(function (item) { return item.good; });
            var excellentData = lembagaScores.map(function (item) { return item.excellent; });

            const radarData = {
                labels: labels,
                datasets: [
                    {
                        label: 'Poor',
                        data: poorData,
                        fill: true,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)'
                    },
                    {
                        label: 'Average',
                        data: averageData,
                        fill: true,
                        backgroundColor: 'rgba(255, 205, 86, 0.2)',
                        borderColor: 'rgb(255, 205, 86)',
                        pointBackgroundColor: 'rgb(255, 205, 86)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 205, 86)'
                    },
                    {
                        label: 'Good',
                        data: goodData,
                        fill: true,
                        backgroundColor: 'rgba(0, 153, 204, 0.2)',
                        borderColor: 'rgb(0, 153, 204)',
                        pointBackgroundColor: 'rgb(0, 153, 204)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: 'rgb(0, 153, 204)',
                        pointHoverBorderColor: '#fff'
                    },
                    {
                        label: 'Excellent',
                        data: excellentData,
                        fill: true,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgb(75, 192, 192)',
                        pointBackgroundColor: 'rgb(75, 192, 192)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(75, 192, 192)'
                    }
                ]
            };

            const config = {
                type: 'radar',
                data: radarData,
                options: {
                    elements: {
                        line: {
                            borderWidth: 3
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var datasetLabel = data.datasets[tooltipItem.datasetIndex].label;
                                var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                var totalMajor = majorData[tooltipItem.index];
                                var totalMinor = minorData[tooltipItem.index];
                                var totalClose = closeData[tooltipItem.index];
                                return label + ': ' + datasetLabel + ' - ' + value + '\n' +
                                       'Major: ' + totalMajor + '\n' +
                                       'Minor: ' + totalMinor + '\n' +
                                       'Close: ' + totalClose;
                            }
                        }
                    },
                    scales: {
                        r: {
                            angleLines: {
                                display: true
                            },
                            grid: {
                                display: true
                            },
                            pointLabels: {
                                display: true,
                                padding: 10,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 1.5,
                                },
                                callback: function(value) {
                                    var maxLength = 0;
                                    if (value.length > maxLength) {
                                        var line1 = value.substring(0, maxLength);
                                        var line2 = value.substring(maxLength);
                                        return line1 + '\n' + line2;
                                    } else {
                                        return value;
                                    }
                                }
                            },
                            ticks: {
                                display: false
                            }
                        }
                    }
                },
            };

            new Chart(ctx2, config);
        });
    </script>





@include('layouts.footer-admin')
@include('layouts.script-admin')
