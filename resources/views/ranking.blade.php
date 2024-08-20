@include('layouts.header-admin')
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
