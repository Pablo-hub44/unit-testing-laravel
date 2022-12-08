@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{ __('Dashboard') }}</div>

                <div class="card-body">
                    if (session('status'))
                        <div class="alert alert-success" role="alert">
                            { session('status') }}
                        </div>
                    endif

                    { __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> -->
    







    <div class="card m-4">
        <div class="card-header">
            Empleados Tipo A (Salario menor a 6K)
        </div>
        <div class="card-body">
            {{-- validamos si tenemos informacion en typeA de data --}}
            @if (isset($data['typeA']))
            <table id="mitabla" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Employee Id</th>
                        <th>Edad</th>
                        <th>Salario</th>
                        <th>Bonus</th>
                        <th>Med Benefits</th>
                        <th>Allowences</th>
                        <th>Leave Expense</th>
                        <th>total</th>
                        <th>Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- iteramos con un foreach data[typeA] pk sabemos hay 3 arreglos importantes en data , typea,typeB,typeC --}}
                    @foreach($data['typeA'] as $typeA)
                        <tr>
                            <td>{{ $typeA['employee_name'] }}</td>
                            <td>{{ $typeA['employee_id'] }}</td>
                            <td>{{ $typeA['age'] }}</td>
                            <td>{{ $typeA['salary'] }}</td>
                            <td>{{ $typeA['bonus'] }}</td>
                            <td>{{ $typeA['med_claims'] }}</td>
                            <td>{{ $typeA['allowences'] }}</td>
                            <td>{{ $typeA['leave_payments'] }}</td>
                            <td>{{ $typeA['totalExpense'] }}</td>
                            <td>{{ $typeA['joined'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
            @endif
        </div>
    </div>





    <div class="card m-4">
        <div class="card-header mt-2">
            Empleados Tipo B (Earnings more than 6k and less than 9k)
        </div>
        <div class="card-body">
            @if(isset($data['typeB']))
            <table id="mitabla2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Employee Id</th>
                        <th>Age</th>
                        <th>Salary</th>
                        <th>Bonus</th>
                        <th>Med Benefits</th>
                        <th>Allowences</th>
                        <th>Leave Expense</th>
                        <th>total</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['typeB'] as $typeB)
                        <tr>
                            <td>{{ $typeB['employee_name'] }}</td>
                            <td>{{ $typeB['employee_id'] }}</td>
                            <td>{{ $typeB['age'] }}</td>
                            <td>{{ $typeB['salary'] }}</td>
                            <td>{{ $typeB['bonus'] }}</td>
                            <td>{{ $typeB['med_claims'] }}</td>
                            <td>{{ $typeB['allowences'] }}</td>
                            <td>{{ $typeB['leave_payments'] }}</td>
                            <td>{{ $typeB['totalExpense'] }}</td>
                            <td>{{ $typeB['joined'] }}</td>
                        </tr>
                    @endforeach
                </tfoot>
            </table>
            @endif
        </div>
    </div>

    <div class="card m-4">
        <div class="card-header mt-2">
            Empleado Tipo C (Earnings more than 9K)
        </div>
        <div class="card-body">
            @if(isset($data['typeC']))
            <table id="mitabla3" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Employee Id</th>
                        <th>Age</th>
                        <th>Salary</th>
                        <th>Bonus</th>
                        <th>Med Benefits</th>
                        <th>Allowences</th>
                        <th>Leave Expense</th>
                        <th>total</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['typeC'] as $typeC)
                        <tr>
                            <td>{{ $typeC['employee_name'] }}</td>
                            <td>{{ $typeC['employee_id'] }}</td>
                            <td>{{ $typeC['age'] }}</td>
                            <td>{{ $typeC['salary'] }}</td>
                            <td>{{ $typeC['bonus'] }}</td>
                            <td>{{ $typeC['med_claims'] }}</td>
                            <td>{{ $typeC['allowences'] }}</td>
                            <td>{{ $typeC['leave_payments'] }}</td>
                            <td>{{ $typeC['totalExpense'] }}</td>
                            <td>{{ $typeC['joined'] }}</td>
                        </tr>
                    @endforeach
                </tfoot>
            </table>
            @endif
        </div>


</div>
@endsection

{{-- para el datatable --}}
@section('scripts')
    <script>
        $(document).ready(function() {
        var table = $('#mitabla').DataTable( {
        fixedHeader: true,
        'iDisplayLength': 5,
        'lengthMenu': [[5, 10,25,50,-1], [5,10,25,50,"All"]], //podemos personalosar todo
            } );
        } );    
        $(document).ready(function() {
        var table = $('#mitabla2').DataTable( {
        fixedHeader: true,
        'iDisplayLength': 5,
        'lengthMenu': [[5, 10,25,50,-1], [5,10,25,50,"All"]], //podemos personalosar todo
            } );
        } );    
        $(document).ready(function() {
        var table = $('#mitabla3').DataTable( {
        fixedHeader: true,
        'iDisplayLength': 5,
        'lengthMenu': [[5, 10,25,50,-1], [5,10,25,50,"All"]], //podemos personalosar todo
            } );
        } );    
    </script>
@endsection
