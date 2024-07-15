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
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Total User</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{$countUser}}
                    <span class="text-success text-sm font-weight-bolder">Akun</span>
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
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
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Lembaga</p>
                  <h5 class="font-weight-bolder mb-0">
                   {{$countLembaga}}
                    <span class="text-primary text-sm font-weight-bolder">Biro</span>
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
      <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4 mt-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Administator</p>
                  <h5 class="font-weight-bolder mb-0">
                   {{$countAdmin}}
                    <span class="text-success text-sm font-weight-bolder">Admin</span>
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="fa fa-user-circle-o text-lg opacity-10" aria-hidden="true"></i>
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
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Dokumen Audit</p>
                  <h5 class="font-weight-bolder mb-0">
                   {{$countDocs}}
                    <span class="text-warning text-sm font-weight-bolder">Dokumen</span>
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
      <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Temuan Audit</p>
                  <h5 class="font-weight-bolder mb-0">
                   {{$countTemuan}}
                    <span class="text-danger text-sm font-weight-bolder">Temuan</span>
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
      <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Auditor</p>
                  <h5 class="font-weight-bolder mb-0">
                   {{$countAuditor}}
                    <span class="text-primary text-sm font-weight-bolder">Auditor</span>
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
      <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Laporan Audit</p>
                  <h5 class="font-weight-bolder mb-0">
                   {{$countLaporan}}
                    <span class="text-secondary text-sm font-weight-bolder">Laporan Audit</span>
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
      <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
        <div class="card">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-lg-6 col-7">
                <h6>Rangking Point</h6>
                <p class="text-sm mb-0">
                  <i class="fa fa-check text-info" aria-hidden="true"></i>
                  <span class="font-weight-bold ms-1">{{$countLembaga}} Lembaga</span> terdaftar
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
                              <tr>
                                  <td class="text-center">
                                      <div class="d-flex px-2 py-1 text-center">
                                          <div class="d-flex flex-column justify-content-center text-center">
                                              <p class="mb-0 text-sm text-center">{{ $index + 1 }}</p>
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
                                      <div class="progress-wrapper w-75 mx-auto">
                                          <div class="progress-info">
                                              <div class="progress-percentage">
                                                  <span class="text-xs font-weight-bold">{{ $lembaga['total_score'] }}</span>
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
      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-header pb-0">
            <h6>Tracking Poin</h6>
            <p class="text-sm">
              <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
              <span class="font-weight-bold">24%</span> this month
            </p>
          </div>
          <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                  @foreach($riwayat as $lembaga)
                      <div class="timeline-block mb-3">
                          <span class="timeline-step">
                              <i class="fa fa-arrow-{{ $lembaga['is_increased'] ? 'up text-success' : 'down text-danger' }}"></i>
                          </span>
                          <div class="timeline-content">
                              <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $lembaga['nama_lembaga'] }}: {{ $lembaga['total_score'] }}</h6>
                              <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $lembaga['updated_at'] ? : 'No update' }}</p>
                          </div>
                      </div>
                  @endforeach
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
          var labels = lembagaScores.map(function (item) { return item.nama_lembaga; });
          var majorData = lembagaScores.map(function (item) { return item.major; });
          var minorData = lembagaScores.map(function (item) { return item.minor; });
          var closeData = lembagaScores.map(function (item) { return item.close; });

          const radarData = {
              labels: labels,
              datasets: [
                  {
                      label: 'Major',
                      data: majorData,
                      fill: true,
                      backgroundColor: 'rgba(255, 99, 132, 0.2)',
                      borderColor: 'rgb(255, 99, 132)',
                      pointBackgroundColor: 'rgb(255, 99, 132)',
                      pointBorderColor: '#fff',
                      pointHoverBackgroundColor: '#fff',
                      pointHoverBorderColor: 'rgb(255, 99, 132)'
                  },
                  {
                      label: 'Minor',
                      data: minorData,
                      fill: true,
                      backgroundColor: 'rgba(255, 205, 86, 0.2)',
                      borderColor: 'rgb(255, 205, 86)',
                      pointBackgroundColor: 'rgb(255, 205, 86)',
                      pointBorderColor: '#fff',
                      pointHoverBackgroundColor: '#fff',
                      pointHoverBorderColor: 'rgb(255, 205, 86)'
                  },
                  {
                      label: 'Close',
                      data: closeData,
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
