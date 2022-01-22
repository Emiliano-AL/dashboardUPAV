@extends('layouts.app')

@section('title_content')
  <h1>Inicio</h1>
@endsection

@section('content2')
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$users}}</h3>

        <p>Usuarios</p>
      </div>
      <div class="icon">
        <i class="fas fa-fw fa-user"></i>
      </div>
      <a href="{{ url('/dashboard/user') }}" class="small-box-footer">Más Información<i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{$student}}</h3>

        <p>Estudiantes</p>
      </div>
      <div class="icon">
        <i class="fas fa-fw fa-graduation-cap"></i>
      </div>
      <a href="{{ url('/dashboard/student') }}" class="small-box-footer">Más Información<i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$validation}}</h3>

        <p>Estudiantes Validados</p>
      </div>
      <div class="icon">
        <i class="fas fa-fw fa-check-double"></i>
      </div>
      <a href="{{ url('/dashboard/validation') }}" class="small-box-footer">Más Información<i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$validationno}}</h3>

        <p>Estudiantes Sin Validar</p>
      </div>
      <div class="icon">
        <i class="fas fa-times-circle"></i>
      </div>
      <a href="{{ url('/dashboard/validation') }}" class="small-box-footer">Más Información<i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-12 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-pie mr-1"></i>
          Usuarios Validados / Sin validar
        </h3>
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Pastel</a>
            </li>
          </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content p-0">
          <!-- Morris chart - Sales -->
          <div class="chart tab-pane active" id="revenue-chart"
               style="position: relative; height: 300px;">
              <canvas id="pieChart" height="300" style="height: 300px;"></canvas>
           </div>
        </div>
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.Left col -->
</div>
<!-- /.row (main row) -->
@endsection

@section('js2')
<script>
  $(function () {
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutData        = {
      labels: [
          'Validados',
          'Sin Validar',
      ],
      datasets: [
        {
          data:
          @php
           echo "[".$validation.",".$validationno."],";
          @endphp
          backgroundColor : ['#28A745','#DC3545',],
        }
      ]
    }
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
  });
</script>
@endsection