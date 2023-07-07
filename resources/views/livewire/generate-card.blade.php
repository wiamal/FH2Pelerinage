
    <?php 
    /*$Adherent = getAdherentFields();
    $conjoint = getAdherentConjoint($Adherent->IdAdherent); 
    $Enfants = getAdherentEnfants($Adherent->IdAdherent);*/
    
    $vueadherent = vueAdherent();
    $vueconjoint = vueConjoint();
    $vueenfant = vueEnfant();
    
    $alldata = array_merge($vueadherent,$vueconjoint,$vueenfant);
    /* dd($alldata);  */
    ?>
        <div class="card-body">
            <div class="bg-secondary">
                <span bg-teal text-white>
                    @if ($checkedAffiliation)
                        nombre de selection : ({{ count($checkedAffiliation) }})
                    @endif
                </span>
            </div>
            <table class="table table-striped" id="datatable">
                <thead>
                    <tr>
                        <th></th>
                        <th>N°Affiliation</th>
                        <th>Qualité</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>CIN</th>
                        <th>PPR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vueadherent as $adherent)
                        
                        <tr>
                            <td>
                                    
                                        <input  type="checkbox" value="{{ $adherent['Aff']}}" wire:model="checkedAffiliation" >
                                    
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
                                
                                    <input type="checkbox" value="{{ $conjoint['Aff']}}"  wire:model="checkedAffiliation">
                               
                            </td>
                            <td>{{ $conjoint['Aff']}}</td>
                            <td><span class="tag tag-success">{{ $adherent['Qualité']}}</span></td>
                            <td>{{ $conjoint['Nom'] }}</td>
                            <td>{{ $conjoint['Prenom'] }}</td>
                            <td>{{ $conjoint['CINConjoint'] }}</td>
                            <td></td>
                        </tr>
                       
                    @endforeach
                    @foreach ($vueenfant as $enfant)
                        
                        <tr>
                            <td>
                                
                                    <input  type="checkbox" value="{{ $enfant['Aff']}}"  wire:model="checkedAffiliation">
                               
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
        </div>

        
        
    
    
  
    
    
