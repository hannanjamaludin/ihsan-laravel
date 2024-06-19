<div class="row">
    <!-- Profile Section -->
    <div class="col-md-12 mt-1 mb-4">
        <div class="card">
            <div class="card-body ps-3 pe-1">
                <div class="row">
                    <div class="col-md-2 d-flex text-center align-items-center">
                        <div class="rounded-circle mx-auto shadow-lg bg-secondary" style="width: 140px; height: 140px; display: flex; justify-content: center; align-items: center;">
                            <i class="fas fa-user-shield" style="font-size: 70px;"></i>
                        </div>
                    </div>
                    <div class="col-md-10 ps-4">
                        <div class="row mb-2">
                            <div class="col-10">
                                <h4 class="text-primary">{{ $user->staffs->full_name }}</h4>
                            </div>
                            <div class="col-2">
                                <div class="text-end me-3">
                                    {{-- <a href="{{ route("admin.profile") }}" class="text-primary fw-light fs-6 text" style="text-decoration: none">Update Profile</a> --}}
                                    <a href="#" class="text-primary fw-light fs-6 text" style="text-decoration: none">Kemaskini</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-auto d-flex align-items-center">
                                <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                    <i class="fa fa-id-badge" style="font-size: 16px;"></i>
                                </div>
                            </div>
                            <div class="col-4 d-flex align-items-center">
                                <div class="text-start">{{ $user->staffs->staff_no }}</div>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                    <i class="fa fa-phone" style="font-size: 16px;"></i>
                                </div>
                            </div>
                            <div class="col-4 d-flex align-items-center">
                                <div class="text-start">{{ $user->staffs->phone_no }}</div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Metrics Section -->
    <div class="col-md-6">
        <div class="custom-container">
            <h4 class="mb-4">Ringkasan Sistem</h4>
            <div class="d-flex flex-row justify-content-between flex-wrap">
                <div class="row w-100 justify-content-center mx-1">    
                    <div class="col-md-6 col-lg-6 mb-3">
                        <div class="class-box p-3 rounded overflow-hidden position-relative text-dark" style="background-color: #D4AFB9">
                            <div class="class-content">
                                <h3 class="display-4 d-block l-h-n m-0 fw-normal">{{ $totalUsers }}</h3>
                                <small class="m-0 l-h-n">Jumlah Pengguna</small>
                            </div>
                            <i class="fa fa-bezier-curve position-absolute icon-bg"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <div class="class-box p-3 rounded overflow-hidden position-relative text-dark" style="background-color: #DCE1E9">
                            <div class="class-content">
                                <h3 class="display-4 d-block l-h-n m-0 fw-normal">{{ $dailyActiveUsers }}</h3>
                                <small class="m-0 l-h-n">Pengguna Aktif Harian</small>
                            </div>
                            <i class="fa fa-object-ungroup position-absolute icon-bg"></i>
                        </div>
                    </div>
                </div>
                <div class="row w-100 justify-content-center mx-1">
                    <div class="col-md-6 col-lg-6 mb-3">
                        <div class="class-box p-3 rounded overflow-hidden position-relative text-dark" style="background-color: #ABB7AA">
                            <div class="class-content">
                                <h3 class="display-4 d-block l-h-n m-0 fw-normal">{{ $weeklyActiveUsers }}</h3>
                                <small class="m-0 l-h-n">Pengguna Aktif Mingguan</small>
                            </div>
                            <i class="fa fa-circle-nodes position-absolute icon-bg"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <div class="class-box p-3 rounded overflow-hidden position-relative text-dark" style="background-color: #EACD94">
                            <div class="class-content">
                                <h3 class="display-4 d-block l-h-n m-0 fw-normal">{{ $monthlyActiveUsers }}</h3>
                                <small class="m-0 l-h-n">Pengguna Aktif Bulanan</small>
                            </div>
                            <i class="fa fa-crop-simple position-absolute icon-bg"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- User Summary Section -->
    <div class="col-md-6">
        <div class="custom-container d-flex flex-column">
            <h4 class="mb-4">Ringkasan Pengguna</h4>
            <div class="d-flex flex-row justify-content-between">
                <div class="chart-container d-flex justify-content-center align-items-center">
                    <canvas id="genderDistributionChart"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="staffStudentChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- User Management Section -->
    <div class="col-md-6">
        <div class="custom-container">
            <h4 class="mb-4">Pengurusan Pengguna</h4>
            @if ($users->isNotEmpty())
                @foreach ($users as $user)
                    <div class="card mb-3" style="background-color: #f2f1f1e7">
                        <div class="card-body ps-3 pe-1">
                            <div class="row">
                                <div class="col-2 text-center">
                                    <div class="rounded-circle mx-auto shadow-lg bg-secondary" style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center;">
                                        <i class="fas fa-user" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="container d-flex align-items-center justify-content-between m-0 p-0">
                                        @if ($user->user_type == 2)
                                            <h5 class="card-title text-primary">{{ $user->staffs->full_name }}</h5> 
                                        @else
                                            <h5 class="card-title text-primary">{{ $user->parents->full_name }}</h5> 
                                        @endif
                                    </div>
                                    <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                        @if ($user->user_type == 2)
                                            @if ($user->staffs->branch_id == 1)
                                                @if ($user->staffs->is_admin == true)
                                                    <div class="badge me-3" style="background-color: #EACD94;">Ketua Pengasuh</div>
                                                @else
                                                    <div class="badge me-3" style="background-color: #EACD94;">Pengasuh</div>
                                                @endif
                                            @else
                                                @if ($user->staffs->is_admin == true)
                                                    <div class="badge me-3" style="background-color: #EACD94;">Guru Besar</div>
                                                @else
                                                    <div class="badge me-3" style="background-color: #EACD94;">Guru</div>
                                                @endif                                                
                                            @endif
                                        @elseif ($user->user_type == 3)
                                            <div class="badge me-3" style="background-color: #B799A7;">Ibu</div>
                                        @else
                                            <div class="badge me-3" style="background-color: #B799A7;">Bapa</div>
                                        @endif  
                                        <div class="card-subtitle fst-italic text-muted">{{ $user->last_login_at }}</div> 
                                    </div>                                             
                                </div>
                            </div>     
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex justify-content-center align-items-center mt-5 pt-5 text-muted">
                    Tiada pengguna
                </div>
            @endif
        </div>
    </div>

    <!-- Class and room section -->
    <div class="col-md-6">
        <div class="custom-container">
            <h4 class="mb-4">Bilik & Kelas</h4>
            @foreach ($class_room as $class)
                @php
                    $total_students = $class->total_students;
                    $capacity = $class->capacity;
                    $percentage = ($total_students / $capacity) * 100;
                @endphp 

                <div class="mb-1">
                    @if ($class->branch == 1)
                        <div class="fst-italic text-muted">{{ $class->class_name }}</div>
                    @else
                        <div class="fst-italic text-muted">{{ $class->age }} {{ $class->class_name }}</div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="progress" style="width: 85%">
                            <div class="progress-bar bg-primary text-light" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="ms-0">
                            <div class="text-muted">{{ $total_students }} / {{ $capacity }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var genderChart = document.getElementById('genderDistributionChart').getContext('2d');
        var staffStudentChart = document.getElementById('staffStudentChart').getContext('2d');
        var dadsCount = @json($dadsCount);
        var momsCount = @json($momsCount);
        var parentStaffCount = @json($parentStaffCount);
        var parentStudentCount = @json($parentStudentCount);

        var genderData = {
            labels: ['Bapa', 'Ibu'],
            datasets: [{
                data: [dadsCount, momsCount],
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
                    text: 'Pengguna Ibu dan Bapa'
                }
            }
        };

        new Chart(genderChart, {
            type: 'doughnut',
            data: genderData,
            options: genderOptions
        });
        
        var staffStudentData = {
            labels: ['Staf UTM', 'Pelajar UTM'],
            datasets: [{
                data: [parentStaffCount, parentStudentCount],
                backgroundColor: [ '#FFAF87', '#FF8E72'],
                hoverBackgroundColor: [ '#FFAF87', '#FF8E72'],
                borderWidth: 0,
            }]
        };

        var staffStudentOptions = {
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
                    text: 'Ibu Bapa Staf dan Pelajar'
                }
            }
        };

        new Chart(staffStudentChart, {
            type: 'doughnut',
            data: staffStudentData,
            options: staffStudentOptions
        });

    });
</script>


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

    .chart-container {
        position: relative;
        width: 48%; 
        height: 300px; 
        margin-right: 1%;
    }

    #genderDistributionChart, 
    #staffStudentChart {
        width: 100% !important;
        height: 100% !important;
    }

    .class-box {
        position: relative;
        min-height: 135px;
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
        font-size: 3.5rem;
    }


</style>
