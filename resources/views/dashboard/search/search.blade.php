@extends('dashboard.dashboard')

@section('styles')

        <link rel="stylesheet" href="{{ asset("css/datatable/dataTables.bootstrap5.min.css") }}"/>
        <link rel="stylesheet" href="{{ asset("css/datatable/select.dataTables.min.css") }}" />

        <style>
            .select-info{
                display:none; 
            }
            .table-striped tbody tr:nth-of-type(2n+1) {
                background-color: #e1eaf8;
            }
            .table-striped tbody tr:hover {
                background-color: #bbd3f9;
                cursor: pointer;
            }
            table.dataTable.table-striped > tbody > tr.odd > * {
            box-shadow: none;
            }
            table.dataTable.table-striped > tbody > tr > td {
            color: #103551;
            }
            table.dataTable.table-striped > tbody > tr.selected > td  {
            color: #fff ;
            }
            .page-item.active .page-link {
                background-color: #3067c0;
                border-color: #e1eaf8;
            }
            .page-link{color:#863ae4}
        </style>
            
       
@endsection

@section('content')

<div class="card d-flex justify-content-center">
     <div class="card-header">
            <form method="get" action="{{ route('search') }}">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm mb-1">
                            <input type="text" class="form-control" name="search" placeholder="Recherche par : Affiliation , CIN , Nom , الإسم"  dir="auto"  value="{{ $textsearch }}" required>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info btn-flat"><i class="fas fa-search"></i></button>
                            </span>
                        </div>
                        @if ($textsearch !='')
                            <div class="alert alert-success" role="alert">
                                Votre texte de recherche : {{"' ". $textsearch ." '" }}
                            </div>
                        @endif
                    </div>
                </div>
            </form>
     </div>

    <div class="card-body">
        <div class="col-md-12">
            <table class="table table-striped display" id="table-search">
                <thead>
                    <th>#</th>
                    <th>Affiliation</th>
                    <th>CIN</th>
                    <th>Nom et Prénom</th>
                    <th dir="rtl" style="text-align: right" >الإسم الكامل</th>
                </thead>
                <tbody>
               
                    @if($adherents->count())
                        @foreach($adherents as $key => $adherent)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $adherent->Affiliation }}</td>
                                <td>{{ $adherent->CIN }}</td>
                                <td>{{ $adherent->Nom .' '. $adherent->Prenom }}</td>
                                <td dir="rtl" style="text-align: right" >
                                    {{ $adherent->NomAr .' '. $adherent->PrenomAr }}
                                </td>
                            </tr>
                        @endforeach  
                    @else
                        <tr>
                            <td colspan="7" class="text-danger" >Aucune donnée trouvée.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <div class="col-md-12"> 
        </div>
    </div> 
    
</div>
@push('scripts')
    
    <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
   
    <script src="{{ asset('js/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/datatable/dataTables.select.min.js') }}"></script>

    <script type="text/javascript">
        var count = "{{ $adherents->count() }}";
        var lang = "{{asset('js/datatable/fr-FR.json')}}";
        
            $(document).ready( function () {
                if (count != 0 ){
                    var table = $('#table-search').DataTable({
                    "select": true,
                    "paging": true,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "language": {"url": lang},
                    "lengthMenu": [5, 15, 30, 60 ,100],
                    });
                }
            });  
       
    </script>
@endpush
@endsection