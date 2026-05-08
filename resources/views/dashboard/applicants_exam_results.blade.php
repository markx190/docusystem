<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top: 50px;">
    <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Dashboard</h1> -->
                </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<main class="subs">
    <div class="container-fluid"> 
        <div class="row charts-docs">
            <div class="col-xl-12 ">
            <div class="card mb-4">  
            <div class="card-header subscription-h">
        <i class="fa fa-edit"></i>
    ENGLISH TEST - RESULTS
</div> 
<div class="card-body">
    <div class="col-md-12">
        <a href="/manage_applicants"><button class="btn btn-primary btn-xs" 
            style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-arrow-left"></i> 
            BACK
            </button>
        </a>
    </div> 
    <div class="row">
        <div class="col-md-9">
            <p style="font-size: 18px;">
            <i class="fa fa-newspaper-o"></i> 
            Applicant Name: <b style="text-transform: uppercase;">{{ $eApplicant->firstname .' '. $eApplicant->middlename .' '. $eApplicant->lastname }}</b><br>
            </p>
        </div>
    </div>
    <hr style="margin-top: -12px;">
    <form method="post" action="/submit_grammar_part1">
    @csrf
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <a href="/grammar_exam_result1/{{ $eApplicant->e_id_no }}">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="far fa-file"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Grammar Test 1</span>
                        <!-- <span class="info-box-number">1,410</span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <a href="/grammar_exam_result2/{{ $eApplicant->e_id_no }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="far fa-file"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Grammar Test 2</span>
                        <!-- <span class="info-box-number">1,410</span> -->
                    </div>
                <!-- /.info-box-content -->
                </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <a href="/listening_exam_result1/{{ $eApplicant->e_id_no }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="far fa-file"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Listening Test 1</span>
                        <!-- <span class="info-box-number">1,410</span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <a href="/listening_exam_result2/{{ $eApplicant->e_id_no }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="far fa-file"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Listening Test 2</span>
                        <!-- <span class="info-box-number">1,410</span> -->
                    </div>
                <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <a href="/print_exam_result_percentage/{{ $eApplicant->e_id_no }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="far fa-file"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Exam Percentage</span>
                        <!-- <span class="info-box-number">1,410</span> -->
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

        </div>
    </div>
    <div class="row s-btn">
        </div>
            </div>
                </div>
                    </div>        
                        </div>
                    <!-- /.container-fluid -->
                </form>
            </section>
        </div>
    </main>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
</style>




