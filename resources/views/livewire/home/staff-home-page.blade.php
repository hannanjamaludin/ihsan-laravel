<div>
    <div class="row">

        {{-- Profile section --}}
        <div class="col-md-12 mt-1 mb-4">
            <div class="card">
                <div class="card-body ps-3 pe-1">
                    <div class="row">
                        <div class="col-md-2 d-flex text-center align-items-center">
                            <div class="rounded-circle mx-auto shadow-lg bg-secondary" style="width: 140px; height: 140px; display: flex; justify-content: center; align-items: center;">
                                <i class="fas fa-user-graduate" style="font-size: 70px;"></i>
                            </div>
                        </div>
                        <div class="col-md-10 ps-4">
                            <div class="row mb-2">
                                <div class="col-10">
                                    <h4 class="text-primary">{{ $user->staffs->full_name }}</h4>
                                </div>
                                <div class="col-2">
                                    <div class="text-end me-3">
                                        <a href="{{ route("pengguna.index") }}" class="text-primary fw-light fs-6 text" style="text-decoration: none">Kemaskini</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto d-flex align-items-center">
                                    <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                        <i class="fa fa-clipboard-user" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <div class="text-start">{{ $user->staff_no }}</div>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                        <i class="fa fa-school-flag" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    @if ($user->staffs->branch_id == 1)
                                        @if ($user->staffs->is_admin == true)
                                            <div class="text-start">Ketua Pengasuh {{ $user->staffs->branch->branch_name }}</div>
                                        @else
                                            <div class="text-start">Pengasuh {{ $user->staffs->branch->branch_name }}</div>
                                        @endif
                                    @else
                                        @if ($user->staffs->is_admin == true)
                                            <div class="text-start">Guru besar {{ $user->staffs->branch->branch_name }}</div>
                                        @else
                                            <div class="text-start">Guru {{ $user->staffs->branch->branch_name }}</div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto d-flex align-items-center">
                                    <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                        <i class="fa fa-id-card" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <div class="text-start">{{ $user->staffs->ic_no ?? '-' }}</div>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                        <i class="fa fa-chalkboard-user" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    @if ($user->staffs->branch_id == 1)
                                        <div class="text-start">{{ $user->staffs->assignedClass->class_name ?? '-' }}</div>
                                    @else
                                        <div class="text-start">{{ $user->staffs->assignedClass->age ?? '' }} {{ $user->staffs->assignedClass->class_name ?? '-' }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto d-flex align-items-center">
                                    <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                        <i class="fa fa-phone" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <div class="text-start">{{ $user->staffs->phone_no }}</div>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                        <i class="fa fa-children" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    @if ($user->staffs->class_room == null)
                                        <div class="text-start">-</div>
                                    @else
                                        <div class="text-start">{{ $user->staffs->assignedClass->total_students }}/{{ $user->staffs->assignedClass->capacity }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Updates Section -->
        <div class="col-md-6">
            <div class="custom-container" style="height: 383px;">
                <h4 class="mb-4">Permohonan Pendaftaran</h4>
                @if ($students->isNotEmpty())
                    @foreach ($students as $s)
                        <div class="card mb-3" style="background-color: #f2f1f1e7">
                            <div class="card-body ps-3 pe-1">
                                <div class="row">
                                    <div class="col-2 text-center">
                                        @if ($s->gender == 'lelaki')
                                            <div class="rounded-circle mx-auto shadow-lg" style="background-color: #bcd2e9; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center;">
                                                @if ($s->branch_id == 1)
                                                    <i class="fas fa-baby" style="font-size: 30px;"></i>
                                                @else
                                                    <i class="fas fa-child" style="font-size: 30px;"></i>
                                                @endif
                                            </div>
                                        @else
                                            <div class="rounded-circle mx-auto shadow-lg" style="background-color: #dac6dd; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center;">
                                                @if ($s->branch_id == 1)
                                                    <i class="fas fa-baby" style="font-size: 30px;"></i>
                                                @else
                                                    <i class="fas fa-child-dress" style="font-size: 30px;"></i>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-10">
                                        <div class="container d-flex align-items-center justify-content-between m-0 p-0">
                                            <h5 class="card-title text-primary">{{ $s->full_name }}</h5> 
                                        </div>
                                        <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                            <div class="card-subtitle text-muted">{{ $s->applicationStatus->updated_at }}</div>   
                                        </div>                                             
                                    </div>
                                </div>     
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="d-flex justify-content-center align-items-center mt-5 pt-5 text-muted">
                        Tiada pendaftaran baharu dihantar
                    </div>
                @endif
            </div>
        </div>

        <!-- Custom Reporting Section -->
        <div class="col-md-6">
            <div class="custom-container d-flex flex-column">
                <h4 class="mb-4">Ringkasan Murid</h4>
                <div class="d-flex flex-row justify-content-between">
                    <div class="chart-container d-flex justify-content-center align-items-center">
                        <canvas id="genderDistributionChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="applicationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        @if ($user->staffs->is_admin == true)
            <!-- Class Section -->
            <div class="col-md-6">
                <div class="custom-container d-flex flex-column">
                    @if ($user->staffs->branch_id == 1)
                        <h4 class="mb-4">Bilik Taska Ihsan</h4>
                    @else
                        <h4 class="mb-4">Kelas Tadika Ihsan</h4>
                    @endif
                    <div class="d-flex flex-row justify-content-between flex-wrap">
                        <div class="row w-100 justify-content-center mx-1">
                            @php
                                $backgroundColors = ['#D4AFB9', '#DCE1E9', '#ABB7AA', '#EACD94', '#B799A7'];
                                $icons = ['fa-plane-up', 'fa-fort-awesome', 'fa-car-rear', 'fa-bucket', 'fa-cake-candles'];
                            @endphp
            
                            @foreach ($classes as $index => $class)
                                @php
                                    $bgColor = $backgroundColors[$index % count($backgroundColors)];
                                    $icon = $icons[$index % count($icons)];
                                @endphp
            
                                <div class="col-sm-6 col-lg-4 mb-3">
                                    <div class="class-box p-3 rounded overflow-hidden position-relative text-dark" style="background-color: {{ $bgColor }}">
                                        <div class="class-content">
                                            <h3 class="display-4 d-block l-h-n m-0 fw-normal">{{ $class->total_students }}</h3>
                                            @if ($user->staffs->branch_id == 1)
                                            <small class="m-0 l-h-n">{{ $class->age }} {{ $class->class_name }}</small>
                                            @else
                            
                                            <small class="m-0 l-h-n">{{ $class->age }} {{ $class->class_name }}</small>
                                            @endif
                                        </div>
                                        <i class="fa {{ $icon }} position-absolute icon-bg"></i>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Section -->
            <div class="col-md-6">
                <div class="custom-container">
                    <h4 class="mb-4">Kehadiran {{ $today }}</h4>
                    @foreach ($classes as $class)
                        @php
                            $attendancePercentage = $attendancePercentages[$class->id] ?? 0;
                            $present = $classAttendance[$class->id]['present'] ?? 0;
                            $total = $classAttendance[$class->id]['total'] ?? 0;
                        @endphp 

                        <div class="mb-1">
                            @if ($user->staffs->branch_id == 1)
                                <div class="fst-italic text-muted">{{ $class->class_name }}</div>
                            @else
                                <div class="fst-italic text-muted">{{ $class->age }} {{ $class->class_name }}</div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="progress" style="width: 85%">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $attendancePercentage }}%" aria-valuenow="{{ $attendancePercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="ms-0">
                                    <div class="text-muted">{{ $present }}/{{ $total }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var genderChart = document.getElementById('genderDistributionChart').getContext('2d');
        var applicationChart = document.getElementById('applicationChart').getContext('2d');
        var boysCount = @json($boysCount);
        var girlsCount = @json($girlsCount);
        var acceptedCount = @json($acceptedCount);
        var rejectedCount = @json($rejectedCount);

        var genderData = {
            labels: ['Lelaki', 'Perempuan'],
            datasets: [{
                data: [boysCount, girlsCount],
                backgroundColor: ['#bcd2e9', '#dac6dd'],
                hoverBackgroundColor: ['#bcd2e9', '#dac6dd'],
                borderWidth: 0,
            }]
        };

        var genderOptions = {
            cutoutPercentage: 80,
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Pembahagian Jantina'
                }
            }
        };

        new Chart(genderChart, {
            type: 'doughnut',
            data: genderData,
            options: genderOptions
        });
        
        var applicationData = {
            labels: ['Diterima', 'Ditolak'],
            datasets: [{
                data: [acceptedCount, rejectedCount],
                backgroundColor: ['#FF8E72', '#FFAF87'],
                hoverBackgroundColor: ['#FF8E72', '#FFAF87'],
                borderWidth: 0,
            }]
        };

        var applicationOptions = {
            cutoutPercentage: 80,
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Pembahagian Permohonan'
                }
            }
        };

        new Chart(applicationChart, {
            type: 'doughnut',
            data: applicationData,
            options: applicationOptions
        });

    });
</script>

<!-- Custom CSS -->
<style>
    .custom-container {
        border-radius: 15px;
        background-color: white;
        padding: 15px;
        margin-bottom: 20px;
        position: relative;
        height: auto;
        display: flex;
        flex-direction: column;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-summary p {
        margin: 0;
    }

    .chart-container {
        position: relative;
        width: 48%; 
        height: 300px; 
        margin-right: 1%
    }

    #genderDistributionChart, 
    #applicationChart {
        width: 100% !important;
        height: 100% !important;
    }

    .class-box {
        position: relative;
        min-height: 100px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .class-content {
        position: relative;
        z-index: 1;
    }

    .icon-bg {
        font-size: 8rem;
        z-index: 0;
        right: -4rem;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.10;
    }

    .display-4 {
        font-size: 2.5rem;
    }

</style>
