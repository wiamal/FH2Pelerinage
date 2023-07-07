@extends('dashboard.dashboard')
@section('styles')
        {{-- @livewireStyles --}}
            <link rel="stylesheet" href="{{ asset("css/datatable/dataTables.bootstrap5.min.css") }}"/>
            <link rel="stylesheet" href="{{ asset("css/datatable/select.dataTables.min.css") }}" />
        <style>
            .select-info{
                display:none; 
            }
            .table-striped tbody tr:nth-of-type(2n+1) {
                background-color: #e1eaf8;
            }
            .page-item.active .page-link {
                background-color: #3067c0;
                border-color: #e1eaf8;
            }
            .page-link{color:#863ae4}
            .select2-selection__choice {
                background-color: #5f8ed8;
                border-color: #e1eaf8;
                color: #fff !important;
            }
        </style>
@endsection
@section('content')
<?php 

use Illuminate\Support\Facades\URL;

    $vueadherent = vueAdherent();
    $vueconjoint = vueConjoint();
    $vueenfant = vueEnfant();
    
    $alldata = array_merge($vueadherent,$vueconjoint,$vueenfant);
    /* dd($alldata);  */
    ?>
<div class="card">
    <div class="card-header bg-secondary">
        <h1 class="card-title text-white">Cartes en Instance</h1>
        <div class="card-tools">
        </div>
    </div>
    {{-- @livewire('generate-card') --}}
    <div class="card-body">
        <div class="bg-secondary">
            <ul class="showData" bg-teal text-white>
                
                {{-- @if ($checkedAffiliation)
                    nombre de selection : ({{ count($checkedAffiliation) }})
            
            
                    @endif --}}
                </ul>
        </div>
        
        <table class="table table-striped display" id="CarteTable">
            <thead>
                <tr>
                    <th><input id="selectAll" type="checkbox"></th>
                    <th>N°Affiliation</th>
                    <th>Qualité</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>CIN Adhérent</th>
                    <th>PPR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vueadherent as $adherent)
                    <tr>
                        <td>
                                   
                        </td>
                        <td>{{ $adherent['Aff']}}</td>
                        <td><span class="tag tag-success">{{ $adherent['Qualité']}}</span></td>
                        <td>{{ $adherent['Nom'] }}</td>
                        <td>{{ $adherent['Prenom'] }}</td>
                        <td>{{ $adherent['CIN'] }}</td>
                        <td>{{ $adherent['PPR'] }}</td>
                    </tr>
                @endforeach
                @foreach ($vueconjoint as $conjoint)
                    <tr>
                        <td>

                        </td>
                        <td>{{ $conjoint['Aff']}}</td>
                        <td><span class="tag tag-success">{{ $conjoint['Qualité']}}</span></td>
                        <td>{{ $conjoint['Nom'] }}</td>
                        <td>{{ $conjoint['Prenom'] }}</td>
                        <td>{{ $conjoint['CINAdhérent'] }}</td>
                        <td></td>
                    </tr>
                   
                @endforeach
                @foreach ($vueenfant as $enfant)
                    
                    <tr>
                        <td>

                        </td>
                        <td>{{ $enfant['Aff']}}</td>
                        <td><span class="tag tag-success">{{ $enfant['Qualité']}}</span></td>
                        <td>{{ $enfant['Nom'] }}</td>
                        <td>{{ $enfant['Prenom'] }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                   
                @endforeach
            </tbody>
        </table>
        <div class="card-footer d-flex justify-content-end">
            <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button id="add_data" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fas fa-check-square mr-2"></i>Imprimer la selection
                    </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="post" id="cards_form" action="{{ route('saveCard') }}">
        <div class="modal-header bg-teal">
          <h5 class="modal-title" id="staticBackdropLabel">Adhérent(s) et/ou (conjoints , enfants) sélectionné(s)</h5>       
        </div>
        @csrf
        @method('POST')
        <div class="modal-body">
            <div class="col-md-12">
                <div class="form-group" id="selectAffiliations" >
                    {{-- <label>Affiliations</label> --}}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button id="send" type="submit" class="btn btn-success" >
                Accepter
          </button>
          <button id="closebtn" type="button" class="btn btn-danger" data-bs-dismiss="modal">
                Annuler
          </button>
        </div>
        </form>
      </div>
    </div>
  </div> 
<!-- The Modal -->
@endsection

@push('scripts')

    <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/datatable/dataTables.select.min.js') }}"></script>
   
<script>
        $(document).ready( function () {
            var table = $('#CarteTable').DataTable({
            "select": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {"url": "{{asset('js/datatable/fr-FR.json')}}"},
            "select": {/* "style" : 'os' */ "style" : 'multi', "selector" : 'td:first-child'},
            "columnDefs": [ { "orderable": false, "className": 'select-checkbox', "targets": 0} ],
            });
            //Initialize Select2 Elements
                $('#add_data').click(function(){
                    var dataAffiliation = [];
                    var selectdata = []; 
                    $( "#send" ).prop('disabled', false);
                    table.rows( { selected: true } ).eq(0).each( function ( index ) {
                        var row = table.row( index );
                        dataAffiliation.push(row.data());
                    });
                    
                    for (let i = 0; i < dataAffiliation.length; i++) {
                       /*  selectdata.push({ "id": i , "text" : dataAffiliation[i][1] , "selected" : true}) ;  */
                        var affiliation = dataAffiliation[i][1] ; var name = dataAffiliation[i][3] +' '+dataAffiliation[i][4]
                        var options = options + '<option value ="'+affiliation+'"'+' selected>'+ 'N°: '+affiliation+' - '+name.toUpperCase()+'</option>';
                    };

                    $("#selectAffiliations").append('<select id ="affchoisis" name="affiliation[]" class="selelectAff select2-purple"'+
                                                        'multiple="multiple" data-placeholder="Affiliation(s) choisi(s)"'+
                                                        'style="width: 100%;" required>'+options+'</select>');
                    $('#affchoisis').select2({
                       /*  data: selectdata, */
                        allowClear: true,
                        theme: 'bootstrap4',
                        width: 'resolve',
                        language: "fr"
                    });
                    
                });

                // load page to refresh table and data 
                $('#closebtn').click(function(){
                    $("#selectAffiliations").empty("#affchoisis");
                    location.reload(true);
                });

                //select all rows 
                $("#selectAll").on("click", function(e) {
                    if ($(this).is(":checked")) {
                        table.rows().select();        
                    } else {
                        table.rows().deselect(); 
                    }
                });

                // event when the form is submited
                $( "#cards_form" ).on( "submit", function( event ) {
                    $( "#send" ).prop('disabled', true);
                    $('#closebtn').html('Fermer');
                });
        });
</script>     
@endpush
{{-- @livewireScripts --}}