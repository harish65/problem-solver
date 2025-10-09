<section class="realtionship-section">
        
         <h2>Relationship</h2>
         <h3>Communication and People Relationship</h3>
         @include('adult.reports.component.people-and-communication')
         @include('adult.reports.component.rel-validation' , ['type'=> 1])
</section>
<section>
         <h2>Communication and Principle Relationship</h2>
         <h3>People Communication</h3>
         @include('adult.reports.component.people-and-communication')
         <h3>Principle</h3>
          @include('adult.reports.component.principle-relationship')
         @include('adult.reports.component.rel-validation', ['type'=>2])
         
</section>
      <section>
         <h2>Communication and Solution Function Relationship</h2>
         <h3>People Communication</h3>
         @include('adult.reports.component.people-and-communication')
         <h3>Problem, Solution, and Solution Function</h3>
         <table>
            <thead>
               <tr>
                  <th>Problem</th>
                  <th>Solution</th>
                  <th>Solution Function</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>{{ $data['problem']['name']}}</td>
                  <td>{{ $data['solution']['name']}}</td>
                  <td>{{ $data['solution_function']['name']}}</td>
               </tr>
            </tbody>
         </table>
         @include('adult.reports.component.rel-validation' , ['type'=> 3])
      </section>
      <section>
         <h2>Communication and Solution Relationship</h2>
         <h3>People Communication</h3>
            @include('adult.reports.component.people-and-communication')
         <h3>Problem, Solution, and Solution Function</h3>
         <table>
            <thead>
               <tr>
                  <th>Problem</th>
                  <th>Solution</th>
                  <th>Solution Function</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                   <td>{{ $data['problem']['name']}}</td>
                  <td>{{ $data['solution']['name']}}</td>
                  <td>{{ $data['solution_function']['name']}}</td>
               </tr>
            </tbody>
         </table>
         @include('adult.reports.component.rel-validation', ['type'=>4])
      </section>
      <section>
         <h2>Entity Usage and Principle Relationship</h2>
         <h3>Entity Usage</h3>
         <?php
          $entity_used = $data['verification'][24]['entities'];
          $entity_used_validations = $data['verification'][24]['validations'];
           
          ?>
         <table>
            <thead>
                <th>Entity</th>
                <th>Actual Entity</th>
                <th>Entity Fucntion</th>
                
            </thead>
            <tbody>

            @foreach($entity_used as $entity)
                <tr>
                    <td>{{ $entity->entity}}</td>
                    <td>{{ $entity->actual_entity}}</td>
                    <td>
                        {{ $data['solution_function']['name']}}
                    </td>
                    

                </tr>
            @endforeach    
            </tbody>
        </table>
         <h3>Principle</h3>
         @include('adult.reports.component.principle-relationship')
         @include('adult.reports.component.rel-validation', ['type'=>5])
      </section>
      <section>
         <h2>Information and Principle Relationship</h2>
         <h3>Information Identified</h3>
         <?php
            $info = $data['verification'][2] ?? []; 
         ?>
         <table>
            <thead>
               <tr>
                  <th>Information Identified</th>
                  <th>Information Given</th>
                  <th>Entity Point To</th>
                  <th>Matched</th>
               </tr>
            </thead>
            <tbody>
               
                @foreach($info['info'] as $ent)
                    <tr>
                        <td>{{ $ent['verification_key'] }}</td>
                        <td>{{ $ent['verification_value'] }}</td>
                        <td>{!! ($ent['point_to'] == 'to')  ? '<i class="fa-solid fa-check"></i>Yes' : 'No' !!}</td>
                        <td>{!! ($ent['point_to'] == 'to')  ? '<i class="fa-solid fa-check"></i>Yes' : 'No' !!}</td>
                    </tr>
               @endforeach
                  
              
            </tbody>
         </table>
         <h3>Principle</h3>
         @include('adult.reports.component.principle-relationship')
         @include('adult.reports.component.rel-validation' ,  ['type'=> 6])
      </section>
      <section>
         <h2>Information and Solution Relationship</h2>
         <h3>Information Identified</h3>
         <table>
            <thead>
               <tr>
                  <th>Information Identified</th>
                  <th>Information Given</th>
                  <th>Entity Point To</th>
                  <th>Matched</th>
               </tr>
            </thead>
            <tbody>
               @foreach($info['info'] as $ent)
                    <tr>
                        <td>{{ $ent['verification_key'] }}</td>
                        <td>{{ $ent['verification_value'] }}</td>
                        <td>{!! ($ent['point_to'] == 'to')  ? '<i class="fa-solid fa-check"></i>Yes' : 'No' !!}</td>
                        <td>{!! ($ent['point_to'] == 'to')  ? '<i class="fa-solid fa-check"></i>Yes' : 'No' !!}</td>
                    </tr>
               @endforeach
            </tbody>
         </table>
         <h3>Problem, Solution, and Solution Function</h3>
         <table>
            <thead>
               <tr>
                  <th>Problem</th>
                  <th>Solution</th>
                  <th>Solution Function</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>{{ $data['problem']['name']}}</td>
                  <td>{{ $data['solution']['name']}}</td>
                  <td>{{ $data['solution_function']['name']}}</td>
               </tr>
            </tbody>
         </table>
         @include('adult.reports.component.rel-validation' , ['type'=>7])
      </section>
      <section>
         <?php
         $people = $data['verification'][18]['people'] ?? [];
         $people_validation = $data['verification'][18]['validations'] ?? [];
         ?>
         <h2>People and Solution Function Relationship</h2>
         <h3>People and Function</h3>
         <table>
            <thead>
               <tr>
                  <th>Person Name</th>
                  <th>Function</th>
               </tr>
            </thead>
            <tbody>
                @foreach($people as $value)
                        @if($value->name != '')
                            <tr>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $data['solution_function']['name'] }}</td>
                            </tr>
                       @endif
               @endforeach    
            </tbody>
         </table>
         <h3>Problem, Solution, and Solution Function</h3>
         <table>
            <thead>
               <tr>
                  <th>Problem</th>
                  <th>Solution</th>
                  <th>Solution Function</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>{{ $data['problem']['name']}}</td>
                  <td>{{ $data['solution']['name']}}</td>
                  <td>{{ $data['solution_function']['name']}}</td>
               </tr>
            </tbody>
         </table>
        @include('adult.reports.component.rel-validation' , ['type'=> 8])
      </section>
      <section>
         <h2>Principle and People Relationship</h2>
         <h3>Principle</h3>
          @include('adult.reports.component.principle-relationship')
         <h3>People and Function</h3>
         <table>
            <thead>
               <tr>
                  <th>Person Name</th>
                  <th>Function</th>
               </tr>
            </thead>
            <tbody>
                @foreach($people as $value)
                        @if($value->name != '')
                            <tr>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $data['solution_function']['name'] }}</td>
                            </tr>
                       @endif
               @endforeach    
            </tbody>
         </table>
         @include('adult.reports.component.rel-validation' , ['type'=> 9])
      </section>
      <section>
         <h2>Principle and Function Relationship</h2>
         <h3>Principle</h3>
         @include('adult.reports.component.principle-relationship')
         <h3>People and Function</h3>
         <table>
            <thead>
               <tr>
                  <th>Person Name</th>
                  <th>Function</th>
               </tr>
            </thead>
            <tbody>
                @foreach($people as $value)
                        @if($value->name != '')
                            <tr>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $data['solution_function']['name'] }}</td>
                            </tr>
                       @endif
               @endforeach    
            </tbody>
         </table>
         @include('adult.reports.component.rel-validation', ['type'=>10])
      </section>
      <section>
         <h2>Principle and Solution Relationship</h2>
         <h3>Principle</h3>
         <!-- Repeat table from above -->
        @include('adult.reports.component.principle-relationship')
         <h3>Problem, Solution, and Solution Function</h3>
         <table>
            <thead>
               <tr>
                  <th>Problem</th>
                  <th>Solution</th>
                  <th>Solution Function</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Dirty Oil</td>
                  <td>New Oil</td>
                  <td>Change Oil</td>
               </tr>
            </tbody>
         </table>
         @include('adult.reports.component.rel-validation' , ['type'=> 11])
      </section>
      <section>
         <h2>Resource Management and Solution Relationship</h2>
         <h3>Problem, Solution, and Solution Function</h3>
         <table>
            <thead>
               <tr>
                  <th>Problem</th>
                  <th>Solution</th>
                  <th>Solution Function</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>{{ $data['problem']['name']}}</td>
                  <td>{{ $data['solution']['name']}}</td>
                  <td>{{ $data['solution_function']['name']}}</td>
               </tr>
            </tbody>
         </table>
         <h3>Entity Usage</h3>
         <?php
          $entity_used = $data['verification'][24]['entities'];
          $entity_used_validations = $data['verification'][24]['validations'];
           
          ?>
         <table>
                                    <thead>
                                        <th>Entity</th>
                                        <th>Actual Entity</th>
                                        <th>Entity Fucntion</th>
                                        
                                    </thead>
                                    <tbody>

                                    @foreach($entity_used as $entity)
                                        <tr>
                                            <td>{{ $entity->entity}}</td>
                                            <td>{{ $entity->actual_entity}}</td>
                                            <td>
                                                {{ $data['solution_function']['name']}}
                                            </td>
                                            

                                        </tr>
                                    @endforeach    
                                    </tbody>
               </table>
        @include('adult.reports.component.rel-validation', ['type'=>13])
      </section>
      <section>
         <h2>Vocabulary and Principle Relationship</h2>
         <h3>Word and Entity Identification</h3>
         <?php
            $voucab = $data['verification'][1] ?? []; 
         ?>
         <table>
            <thead>
               <tr>
                  <th>Word</th>
                  <th>Actual Entity</th>
               </tr>
            </thead>
            <tbody>
               @foreach($voucab['voucab'] as $ent)
               
               <tr>
                  <td>{{ $ent['verification_key'] }}</td>
                  <td>{{ $ent['verification_value'] }}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <h3>Principle</h3>
         <!-- Repeat table -->
         @include('adult.reports.component.principle-relationship')
         @include('adult.reports.component.rel-validation', ['type'=>14])
      </section>