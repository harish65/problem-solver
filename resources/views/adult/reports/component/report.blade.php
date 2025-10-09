

<div class="row border border-success mt-5 border-4 bg-white  shadow-lg p-3 mb-5 bg-white rounded">
    <h1>Project : {{ $project_name }}</h1>
     @if($data['shared_project_data']['editable_problem'])
      <section>
         <div><strong>User Name:</strong> {{ strtoupper($data['user']['name'])}}</div>
         <p><strong>Project Name:</strong> {{ $data['project']}}</p>
         <p><strong>Problem:</strong> <span class="danger">{{ $data['problem']['name']}}</span></p>
         <p class="ml-20"><strong>Have you performed analysis to identify the problem correctly?</strong></p>
         @if($data['problem']['validation'] == 0)
         <div class="answer ml-20"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I have performed analysis to identify the problem correctly</div>
         @else
          <div class="answer ml-20"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I have not performed analysis to identify the problem correctly</div>
         @endif
      </section>
      @endif
	             
      <section>
         <div>
            @if($data['shared_project_data']['editable_solution'])
               <p><strong>Solution:</strong> <span class="success">{{ $data['solution']['name'] }}</span></p>
               <p class="ml-20"><strong>Does the solution of the actual problem replace the actual problem?</strong></p>
               @if($data['solution']['validation_first'] == 0)
               <div class="answer  ml-20"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the solution of the actual problem replaces the actual problem</div>
               @else
               <div class="answer  ml-20"><span class="no"><i class="fa-solid fa-check"></i> No</span>, the solution of the actual problem does not replace the actual problem</div>
               @endif
               <p class="ml-20"><strong>Does the (solution name pull from the database) solve the (problem name pull from the database)?</strong></p>
               @if($data['solution']['validation_second'] == 0)
                  <div class="answer  ml-20"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the solution of the actual problem replaces the actual problem</div>
               @else
                  <div class="answer  ml-20"><span class="no"><i class="fa-solid fa-check"></i> No</span>, (solution name form database) does not solve (problem name from database)</div>
               @endif
            @endif

         @if($data['shared_project_data']['editable_solution_func'])
               <p class=""><strong>Solution Function:</strong> <span class="success">{{ $data['solution_function']['name']  }}</span></p>

               <p class="ml-20"><strong>Does the solution function enable the replacement of the problem?</strong></p>
               @if($data['solution']['validation_first'] == 1)
               <div class="answer  ml-20"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the solution function enables the replacement of the problem </div>
               @else
               <div class="answer  ml-20"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>,  the solution function enables the replacement of the problem </div>
               @endif

               <p class="ml-20"><strong>Does the solution function enable the solving of the ProblemName?</strong></p>
               @if($data['solution_function']['validation_second'] == 0)
                  <div class="answer  ml-20"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the solution of the actual problem replaces the actual problem</div>
            
               @endif
            @endif


            
         </div>
      </section>
      <section>
         <table>
            <thead>
               <tr>
                  <th>Problem Identification</th>
                  <th>Solution Identification</th>
                  <th>Solution Function Identification</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td><span class="danger">{{ strtoupper($data['problem']['name'])}}</span></td>
                  <td><span class="success">{{ strtoupper($data['solution']['name'])}}</span></td>
                  <td><span class="success">{{ strtoupper($data['solution_function']['name'])}}</span></td>
               </tr>
            </tbody>
         </table>
      </section>

      <?php 
            $beforeAndAfterVal = $data['verification'][3]['validations'] ?? [];

            
         ?>
   @if(!empty($beforeAndAfterVal))
   <?php
            $validation1 = $beforeAndAfterVal['validation_1'] ?? null;
            $validation2 = $beforeAndAfterVal['validation_2'] ?? null;
   ?>
      <section class="verification-section">   <!-- Section Before Problem Existed After Problem Solved Verification -->
         <h2>Verification</h2>
         <h3>Before Problem Existed After Problem Solved Verification</h3>
         <table>
            <thead>
               <tr>
                  <th>Before</th>
                  <th>After</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td><span class="danger">{{ strtoupper($data['problem']['name']) }}</span></td>
                  <td><span class="success">{{ strtoupper($data['solution']['name']) }}</span></td>
               </tr>
            </tbody>
         </table>
         
         <p><strong>The problem existed before, is the problem solved after?</strong></p>
         @if($validation1 == 1)
            <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the problem existed before and after the problem is solved</div>
         @else
            <div class="answer"><span class="no"><i class="fa-solid fa-xmark"></i> No</span>, the problem still exists after</div>
         @endif
         <p><strong>The problem existed before, is the problem solved after function execution?</strong></p>
         @if($validation2 == 1)
            <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the problem is solved after function execution</div>
         @else
            <div class="answer"><span class="no"><i class="fa-solid fa-xmark"></i> No</span>, the problem still exists after function execution</div>
         @endif
      </section>
      @endif
      <!-- Entity Available  -->
      @include('adult.reports.component.entity_available',$data)
      <!-- End of Entity Available  -->

      <!-- Voucab Verification -->
       
       <?php 
            $vocabVal = $voucab['validations'] ?? [];
            
            ?>
            @if(!empty($vocabVal))
      <section>
         <?php
            $voucab = $data['verification'][1] ?? []; 
         ?>
         <h2>Problem &amp; Solution Vocabulary Verification</h2>
         <h3>Word and Entity Identification</h3>
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
         <?php 
           
            $validation1 = $vocabVal['validation_1'] ?? null;
            $validation2 = $vocabVal['validation_2'] ?? null;
            $validation3 = $vocabVal['validation_3'] ?? null;  
           // dd($validation1, $validation2, $validation3);
            ?>
            <p><strong>Do I use any word that does not me solve the identified problem?</strong></p>
            @if($validation1 == 1)
            <div class="answer"><span class="yes">Yes</span>, I use words that does not help me solve the problem</div>
            @else
            <div class="answer"><span class="no">No</span>, I don't use any word that does not help me solve the problem</div>
            @endif

            <p><strong>Does each word from the vocabulary match to actual entity that enables solving the problem?</strong></p>
            @if($validation2 == 1)
            <div class="answer"><span class="yes">Yes</span>, each word from the vocabulary matches to actual entity that enables me to solve the problem</div>
            @else
            <div class="answer"><span class="no">No</span>, some words I used in my vocabulary does not match to actual entity that enables me to solve the problem</div>
            @endif


            <p><strong>Do you understand that the solution of a problem is given with its own vocabulary and does not include any word that does not help solve the problem?</strong></p>
            @if($validation3 == 1)
            <div class="answer"><span class="yes">Yes</span>,  I understand that the solution of a problem is given with its own vocabulary and does not include any word that does not help me solve the problem</div>
            @else
            <div class="answer"><span class="no">No</span>,  I do not understand that the solution of a problem is given with its own vocabulary and does not include any word that does not help me solve the problem</div>
            @endif
      </section>
      <!-- End of Voucab Verification -->
       @endif
        <?php
            $info = $data['verification'][2] ?? []; 
            $info_validation1 = $info['validations']['validation_1'] ?? null;
           
         ?>
         @if(!empty($info['validations']))
      <section>
        
         <h2>Problem &amp; Solution Information Verification</h2>
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
               <tr>
                   @foreach($info['info'] as $ent)
               
               <tr>
                  <td>{{ $ent['verification_key'] }}</td>
                  <td>{{ $ent['verification_value'] }}</td>
                  <td>{!! ($ent['point_to'] == 'to')  ? '<i class="fa-solid fa-check"></i>Yes' : 'No' !!}</td>
                  <td>{!! ($ent['point_to'] == 'to')  ? '<i class="fa-solid fa-check"></i>Yes' : 'No' !!}</td>
               </tr>
               @endforeach
                  
               </tr>
            </tbody>
         </table>
         <p><strong>Does the identified information match the given information?</strong></p>
         @if($info_validation1 == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the identified information matches the given information</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>, the identified information does not match the given information</div>
         @endif
      </section>
      @endif
      <!-- Separtaion step -->
         <?php 
               $separtionStep = $data['verification'][4]['sepration_step'] ?? [];
               $separtionStepValidation = $data['verification'][4]['validations'] ?? [];

               $validation_sep1 = $separtionStepValidation['validation_1'] ?? null;
               $validation_sep2 = $separtionStepValidation['validation_2'] ?? null;
               
         ?>
         @if(!empty($validation_sep1) && !empty($validation_sep2))
            <section>
               <h2>Problem, Solution, and People Separation Verification</h2>
               <p><strong>Problem:</strong> <span class="danger">{{ $data['problem']['name'] }}</span></p>
               <p><strong>Solution:</strong> <span class="success">{{ $data['solution']['name'] }}</span></p>
               
               <p><strong>People:</strong> Michael, John, Janet</p>
               <p class="ml-20"><strong>Have you separated the problem from yourself?</strong></p>
               @if($validation_sep1 == 1)
               <div class="answer ml-20"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I have separated the problem from myself</div>
               @else
               <div class="answer ml-20"><span class="no"><i class="fa-solid fa-check"></i> No</span>, I haven't separated the problem from myself</div>
               @endif
               <p class="ml-20"><strong>Have you separated the problem from the people?</strong></p>
               @if($validation_sep2 == 1)
               <div class="answer ml-20"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I have separated the problem from the people</div>
               @else
               <div class="answer ml-20"><span class="no"><i class="fa-solid fa-check"></i> No</span>, I haven’t separated the problem from the people</div>   
               @endif
            </section>
         @endif
      <!-- Time Verification -->
        <?php
         $TimeVerification = $data['verification'][5]['TimeVerification'] ?? [];
         $timeValidation  =  $data['verification'][5]['validations'] ?? [];
        
         ?>
          @if(!empty($timeValidation))
      <section>
        
         <h2>Problem &amp; Solution Existence Related to Time Verification</h2>
         <table>
            <thead>
               <tr>
                  <th>Date</th>
                  <th>Solution Hold</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($TimeVerification as $time)
                   <tr>
                        <td>{{ date('m/d/Y' , strtotime($time['date'])) }}</td>
                        <td><span class="yes">{!! ($time['solution_hold']) ? '<i class="fa-solid fa-check"></i> Yes</span>' : 'No' !!}</td>
                  </tr>
               @endforeach
            </tbody>
         </table>
         <p><strong>Does the solution of the problem hold related to time?</strong></p>
         @if(isset($timeValidation['validation_1'])  && $timeValidation['validation_1'] == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the solution of the problem holds related to time</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> NO</span>, the solution of the problem does not hold related to time</div>
         @endif
      </section>
      @endif
       <!-- Past Time to Present Time -->
        <?php
         $PastAndPresentTime = $data['verification'][6]['PastAndPresentTime'] ?? [];
         $PastAndPresentTimeValidation  =  $data['verification'][6]['validations'] ?? [];
        
         ?>
         @if(!empty($PastAndPresentTimeValidation))
         <section>
            
            <h2>Past Time to Present Time Problem Existence Verification</h2>
            <table>
               <thead>
                  <tr>
                     <th>Date</th>
                     <th>Problem</th>
                  </tr>
               </thead>
               <tbody>
                  
                  @foreach ($PastAndPresentTime as $time)
                     <tr>
                           <td>{{ date('m/d/Y' , strtotime($time['time'])) }}</td>
                           <td><span class="danger">{{ $data['problem']['name']}}</span></td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
            <p><strong>Does the problem exist from past to present?</strong></p>
            @if($PastAndPresentTimeValidation['validation_1'] == 1)
            <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the problem has existed from the past to present</div>
            @else
            <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>, the problem has not existed from the past to present</div>
            @endif
         </section>
         @endif
      <!-- Principle Identification Verification -->
       <?php
         $allVarifications = $data['verification'][14]['allVarifications'] ?? []; 

         // echo '<pre>';print_r($allVarifications);die;
         $content = $data['verification'][14]['content'] ?? [];
        $principle_Validation  =  $data['verification'][14]['validations'] ?? [];
         ?>
         @if(!empty($principle_Validation))
      <section>
         
         <h2>Principle Identification Verification</h2>
         <table>
            <thead>
               <tr>
                  <th>Principle Count</th>
                  <th>Actual Principle</th>
                  <th>Usage</th>
               </tr>
            </thead>
            <tbody>
               
               @foreach($allVarifications as $key=> $value)
                     @php
                           
                     $applicable = \App\Models\PrincipleIdentificationMain::getApplicable($project_id , @$content->principle_type ,  $value->id);
                     

                     @endphp
                     
                     @if(isset($content->principle_type) &&  $content->principle_type == 0 && ($value->id == 4 || $value->id == 5 || $value->id == 10) ) 
                     <tr>
                           <td>{{ ++$key }}</td>
                           <td>{{ $value->text }}</td>
                           <td>{!! ($applicable == 1) ? '<i class="fa-solid fa-check"></i>Yes':'No' !!}</td>
                           
                     </tr>
                     @else
                     <tr> 
                           @if($value->id != 4 && $value->id != 5 && $value->id != 10)
                              <td>{{ ++$key }}</td>
                              <td>{{ $value->text }}</td>
                              <td>{!! ($applicable == 1) ? '<i class="fa-solid fa-check"></i>Yes':'No'  !!}</td>
                              
                           @endif
                     </tr>
                     @endif
               @endforeach
                                        
            </tbody>
         </table>
         <p><strong>Do you use principles to solve the underlying problem?</strong></p>
         @if($principle_Validation['validation_1'] == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I use principles to solve the underlying problem.</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>, I don’t use principles to solve the underlying problem.</div>
         @endif
         <p><strong>Do people use principles to solve the problem?</strong></p>
         @if($principle_Validation['validation_1'] == 2)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, people user principles to solve the problem</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>, people don’t use principles to solve the problem</div>
         @endif
      </section>
      @endif
      

         <?php 
         $custommers = $data['verification'][10]['custommers'] ?? [];
         $custommers_validations = $data['verification'][10]['validations'] ?? [];

         $custommers_validations1 = $custommers_validations['validation_1'] ?? null;
         $custommers_validations2 = $custommers_validations['validation_2'] ?? null;
         $custommers_validations3 = $custommers_validations['validation_3'] ?? null;
         ?>
         @if(!empty($custommers_validations))
            <section>
               <h2>People in Project Verification</h2>
               
               <table>
                  <thead>
                     <tr>
                        <th>Person Name</th>
                        <th>Person Title</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($custommers as $user)
                     <tr>
                        <td> {{ $user['name'] }}</td>
                        <td>{{ $user['type'] }}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               <p><strong>Are you part of that project?</strong></p>
               @if($custommers_validations1 == 1)
               <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I am part of that project</div>
               @else
               <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,I am not part of that project</div>
               @endif
               <p><strong>Do you have a function in that project?</strong></p>
               @if($custommers_validations2 == 1)
               
               <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>,  I do have a function in that project</div>
               @else
               <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,I do not have a function in that project</div>
               @endif
               <p><strong>Do you involve in that project?</strong></p>
               @if($custommers_validations3 == 1)
               
               <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I involve in that project</div>
               @else
               <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,I don’t involve in that project</div>
               @endif
            
            </section>
         @endif
         <?php
         $communications = $data['verification'][11]['communications'] ?? [];
         $communication_validation = $data['verification'][11]['validations'] ?? [];
          
         ?>
         @if(!empty($communication_validation))
      <section>
         
         <h2>People and Communication Separation Verification</h2>
         <table>
            <thead>
               <tr>
                  <th>Person Name</th>
                  <th>Communication</th>
                  <th>People Communication</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($communications as $communication)
               <tr>
                  <td>{{ $communication['customer_name'] }}</td>
                  <td>{{ $communication['customer_name'] }} Communication</td>
                  <td>{{ strip_tags($communication['comment']) }}</td>
               </tr>
              @endforeach
            </tbody>
         </table>
         <p><strong>Have you separated the people in the project from their communication?</strong></p>
         @if($communication_validation['validation_1'] == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I have separated the people in the project from their communication</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>, I have not separated the people in the project form their communication</div>
         @endif

         <p><strong>Do you understand that separation of people and communication is important in a project?</strong></p>
          @if($communication_validation['validation_2'] == 2)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>,  I do understand that separation of people and communication is important in a project</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,   I don’t understand that separation of people and communication is important in a project</div>
         @endif
      </section>
      @endif
      <?php
         $communicationsFlow = $data['verification'][12]['users'] ?? [];
         $communicationFlow_validation = $data['verification'][12]['validations'] ?? [];
            // echo '<pre>';print_r($communicationsFlow);die;
         ?>
      @if(!empty($communicationFlow_validation))
      <section>
         
         <h2>Communication Flow of People in Project Verification</h2>
         <table>
            <thead>
               <tr>
                  <th>Person Name</th>
                  <th>Communication Flow</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($communicationsFlow as $flow)
               <?php $scond_person = \App\Models\Customer::where(['id' => $flow->person_to , 'project_id' => $project_id])->pluck('name')->first(); ?>

                <tr>
                  <td>{{ $flow->name }}</td>
                  <td>Communication flows from {{ $flow->name }} to {{ $scond_person }} and from {{ $scond_person }} to {{ $flow->name }}</td>
               </tr>
                  
               @endforeach
              
              
            </tbody>
         </table>
         <p><strong>Do I communicate with others to solve the underlying problem?</strong></p>
         @if($communicationFlow_validation['validation_1'] == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>,  I communicate with others to solve the problem</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I do not communicate with others to solve the problem</div>
         @endif
      </section>
      @endif
         <?php
         $visibilityEntity = $data['verification'][26]['entiesBehind'] ?? [];
         $visibilityEntity_validation = $data['verification'][26]['validations'] ?? [];
            
         ?>

         @if(!empty($visibilityEntity_validation))
      <section>
         
         

         <h2>Visibility and Entity Behind Verification</h2>
         <table>
            <thead>
               <tr>
                  <th>Entity Name</th>
                  <th>Put Behind</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($visibilityEntity as $ent)
               <tr>
                  <td>{{ $ent->entity_name }}</td>
               
                  <td>
                     {!! ($ent->put_behind == 0) ?  '<i class="fa-solid fa-check"></i>Yes' :  '<span class="no"><i class="fa-solid fa-xmark"></i> No</span>' !!}
                  
               
               </td>
               </tr>
              @endforeach
            </tbody>
         </table>
         <p><strong>To solve the problem, do you feel you have something you want to put behind you that will not help you in solving the problem?</strong></p>
         @if($visibilityEntity_validation['validation_1'] == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>,  I do have things I want to put behind me that will not help solve the problem</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I have nothing to put behind that will not help me solve the problem.</div>
         @endif


         <p><strong>Do you understand that the solution of a problem is given for that problem and does not include any outside entity that is not needed to solve that problem?</strong></p>
         @if($visibilityEntity_validation['validation_2'] == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I understand that the solution of a problem is given for that problem and does not include any outside entity that is not needed to solve that problem</div>
         @else
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I do not understand that the solution of a problem is given for that problem and does not include any outside entity that is not needed to solve that problem</div>
         @endif
      </section>
         @endif
         <?php
         $partitionApproach = $data['verification'][13]['partition_approach'] ?? [];    
         $partitionApproach_validation = $data['verification'][13]['validations'] ?? [];
              
            ?>
            @if(!empty($partitionApproach_validation))
      <section>
         
         <h2>Partition Approach Verification</h2>
         
         <table>
            <thead>
               <th>Problem Part</th>
               <th>Solution Part</th>
            </thead>
            <tbody>
               
             @foreach ($partitionApproach as $value)
                  <tr>
                  <td>Part {{ $value['word'] }}</td>
                  <td>Part {{ $value['given']}}</td>
               </tr>
               @endforeach
            
         </tbody></table>
         <p><strong>Have you replaced each part of the problem to specific part of the solution?</strong></p>
         @if($partitionApproach_validation['validation_1'] == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I have replaced each part of the problem to specific part of the solution</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I haven’t not replaced each part of the problem to specific part of the solution</div>
         @endif
      </section>
      @endif
      <?php
         $people = $data['verification'][18]['people'] ?? [];
         $people_validation = $data['verification'][18]['validations'] ?? [];
         ?>
       @if(!empty($people_validation))
      <section>
         
         <h2>Function Substitution and People Verification</h2>
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
         <p><strong>Do I target the right function?</strong></p>
         @if($people_validation['validation_1'] == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>,  I target the right function</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> Yes</span>, I don’t target the right function.</div>
         @endif
         <p><strong>Do I understand that I can only look at functions that belong to me when trying to solve a problem?</strong></p>
         @if($people_validation['validation_2'] == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>,  I understand that I can only look at functions that belong to me when trying to solve a problem</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>, I don’t understand that I can only look at functions that belong to me when trying to solve a problem</div>
         @endif
      </section>
      @endif
      <?php
         // echo '<pre>';print_r($data['verification'][16]['problemDevelopment']);die;
         $problemDevelopment = $data['verification'][16]['problemDevelopment'];
         ?>
   @if(!empty($problemDevelopment))
      <h2>Problem Development Step Verification</h2>
      <section>
         
         <h2>Error Identification</h2>
         <table>
            <thead>
               <th>Actual Error Identified</th>
               <th>Error Date</th>
               <th>Problem Developed</th>  
                                             
            </thead>
            <tbody>
              @foreach($problemDevelopment as $value)
                           <tr>
                              <td>{{ $value['error_name']}}</td>
                              <td>{{ date('d-m-Y' , strtotime($value['error_date'])) }}</td>
                              <td>{{ $value['problem_name']  }}</td>
                           </tr>
                                        
               @endforeach
            </tbody>
         </table>
         <p></p>
         <div class="answer"><span class="yes"></div>
      </section>
      @endif
      @if(!empty($problemDevelopment))
      <section>
         
         <h2>Compensator Identification</h2>
         <table>
            <thead>
               <tr>
                  <th>Error Identified</th>
                  <th>Compensator Identified</th>
                  <th>Date</th>
               </tr>
            </thead>
            <tbody>
               @foreach($problemDevelopment as $value)
                           <tr>
                              <td>{{$value['error_name']}}</td>
                              <td>{{($value['compensator'] == null) ? 'Not Identified' : $value['compensator']}}</td>
                              <td>{{($value['compensator_date'] != '') ?  date('d-m-Y' , strtotime($value['compensator_date'])) : 'Not Identified' }}</td>
                           </tr>
                                        
               @endforeach
            </tbody>
         </table>
         <p></p>
         <div class="answer"></div>
      </section>
       @endif
         <?php
         //echo '<pre>';print_r($data['verification'][16]['feedBack']);die;
         $feedBack = $data['verification'][16]['feedBack'];
         ?>
      @if(!empty($feedBack))
      <section>
         
         <h2>Feedback Identification</h2>
         <table>
            <thead>
               <tr>
                  <th>Actual Error</th>
                  <th>Actual Feedback</th>
                  <th>Feedback Date</th>
                  <th>From Person</th>
               </tr>
            </thead>
            <tbody>
               
                  @foreach($feedBack as $value)
                                    <tr>
                                        <td>{{ $value['error_name'] }}</td>
                                        <td>{{ $value['feedback'] }}</td>
                                        <td>{{ date('d/m/Y' , strtotime($value['feedback_date'])) }} </td>
                                        <td>{{ $value['from_person'] }}</td>
                                        
                                    </tr>
                                    @endforeach
              
            </tbody>
         </table>
         <p></p>
         <div class="answer"></div>
      </section>
      @endif
      <?php
         $errorcorrections = $data['verification'][16]['errorcorrection']['errorcorrections'];
        
         ?>
   @if($errorcorrections->count() > 0)
      <section>
         
         <h2>Error Correction or Feedback Applied</h2>
         <table>
            <thead>
               <tr>
                  <th>Error Identify</th>
                  <th>Compensator substituted</th>
                  <th>Feedback given (yes/no)</th>
                  <th>Feedback Applied (yes/no)</th>
               </tr>
            </thead>
            <tbody>
               @foreach($errorcorrections as $errorcorrection)
                                @php
                                    $errors = json_decode($errorcorrection->error);
                                    
                                    $errors_ =  DB::table('problem_development')->whereIn('id' , $errors)->get();
                                    $comp = json_decode($errorcorrection->compensator);
                                   
                                    $compensators_ = DB::table('error_correction')->whereIn('id' , $comp)->get();
                                     
                                @endphp
                                 <tr>
                                    <td>
                                        <ul>
                                            @foreach ($errors_ as $error_)
                                                <li>
                                                    {{ $error_->error_name }}
                                                </li>
                                            @endforeach
                                            
                                        </ul>
                                        </td>
                                    <td>
                                        <ul>
                                            @foreach ($compensators_ as $compensator_)
                                                <li>
                                                    {{ $compensator_->compensator }}
                                                </li>
                                            @endforeach
                                           
                                        </ul>
                                    </td>
                                    <td>
                                        
                                        {{ ($errorcorrection->feedback == 0) ? 'Yes' : 'No' }}
                                    </td>
                                    <td>{{($errorcorrection->feedback_applied == 0) ? 'Yes' : 'No' }}</td>
                                </tr>
                @endforeach
            </tbody>
         </table>
         <p></p>
         <div class="answer"></div>
      </section>
      @endif
      <?php
          $entity_used = $data['verification'][24]['entities'];
          $entity_used_validations = $data['verification'][24]['validations'];
           
          ?>
      @if(!empty($entity_used_validations))
         <section>
         <h2>Resource Management Consideration Verification</h2>
         <p><strong>Problem:</strong> <span class="danger">{{ $data['problem']['name']}}</span></p>
         <p><strong>Solution:</strong> <span class="success">{{ $data['solution']['name']}}</span></p>
            <h3>Entity Usage</h3>
            
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
            <p>Have you used the entities to solve the underlying problem?</p>
            @if($entity_used_validations['validation_1'] == 1)
            <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I have used the entities to solve the problem</div>
            @else
            <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I haven’t used the entities to solve the problem.</div>
            @endif
            <p>Do the entities that are used can be substituted for the problem?</p>

            @if($entity_used_validations['validation_2'] == 1)
            <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the entities that are used can be substituted for the problem</div>
            @else
            <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>, the entities that are used cannot be substituted for the problem.</div>
            @endif
         </section>
      @endif
      <?php
            $principleUsage = $data['verification'][27]['principle_identification_usage'];
            $principle_identification = $data['verification'][27]['principle_identification'];
            
         ?>
      @if(!empty($principleUsage) && !empty($principleUsage))
      <section>
         <h2>Mother Nature Existence Verification</h2>
        <p><strong>Problem:</strong> <span class="danger">{{ $data['problem']['name']}}</span></p>
        <p><strong>Solution:</strong> <span class="success">{{ $data['solution']['name']}}</span></p>
         <p><strong>Solution Function:</strong> {{ $data['solution_function']['name'] }}</p>
         <h3>Principle Usage</h3>
         
         <table>
                  <thead>
                  <th>Principle Count 12</th>
                  <th>Actual Principle</th>
                  <th>Usage</th>
                  
                  </thead>
                  <tbody>
                        @foreach($principle_identification as $key=> $value)
                              @php
                                    
                              $applicable = \App\Models\PrincipleIdentificationMain::getApplicable($project_id , @$principleUsage->principle_type ,  $value->id);
                              

                              @endphp
                              
                              @if(isset($principleUsage->principle_type) &&  $principleUsage->principle_type == 0 && ($value->id == 4 || $value->id == 5 || $value->id == 10) ) 
                              <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->text }}</td>
                                    <td>{{ ($applicable == 1) ? 'Yes':'No' }}</td>
                                    
                              </tr>
                              @else
                              <tr> 
                                    @if($value->id != 4 && $value->id != 5 && $value->id != 10)
                                       <td>{{ ++$key }}</td>
                                       <td>{{ $value->text }}</td>
                                       <td>{{ ($applicable == 1) ? 'Yes':'No'  }}</td>
                                       
                                    @endif
                              </tr>
                              @endif
                        @endforeach
                  </tbody>
               </table>
      </section>
       @endif
         <?php 
         $custommers = $data['verification'][8]['custommers'];
         $sol_loc_one_validation = $data['verification'][8]['validations'];
         ?>

      @if(!empty($sol_loc_one_validation))
            <section>
               <h2>Solution Time Location 1 Verification</h2>
               
            <table class="">
                        <thead>
                           <th>Problem</th>
                           <th>Date</th>
                           <th>Solution Function</th>
                           <th>Date</th>
                           <th>People</th>
                        </thead>
                        <tbody>
                           <tr>
                                 <td>{{  $data['problem']['name'] }}</td>
                                 <td>{{  date('d/m/Y', strtotime($data['problem']['created_at']))}}
                                 </td>
                                 <td>{{ $data['solution_function']['name'] }}</td>
                                 <td>{{ date('d/m/Y', strtotime($data['solution_function']['created_at']))}}</td>
                                 <td>
                                       <ul>
                                          @foreach($custommers as $user)
                                             <li>{{ $user->name }}</li>
                                          @endforeach
                                       </ul>
                                 </td>
                           </tr>
                        </tbody>
                     </table>
               <p>Have you separated the problem from yourself?</p>
               @if($sol_loc_one_validation['validation_1'] == 1)
               <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I have separated the problem from myself</div>
               @else
               <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I haven’t separated the problem from myself</div>
               @endif

               <p>Have you separated the problem from the people?</p>
               @if($sol_loc_one_validation['validation_2'] == 1)
                  <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I have separated the problem from the people</div>
               @else
                  <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I haven’t separated the problem from the people</div>
               @endif
            </section>
      @endif
       <?php
         $custommers = $data['verification'][8]['custommers'];
         $sol_loc_two_validation = $data['verification'][9]['validations'];
         ?>
@if(!empty($sol_loc_two_validation))
      <section>
         <h2>Solution Time Location 2 Verification</h2>
        
         <table>
            <thead>
                     <th>Problem</th>
                     <th>Date</th>
                     <th>Solution Function</th>
                     <th>Date</th>
                     <th>People</th>
                  </thead>
                  <tbody>
                     <tr>
                           <td>{{  $data['problem']['name'] }}</td>
                           <td>{{  date('d/m/Y', strtotime($data['problem']['created_at']))}}
                           </td>
                           <td>{{ $data['solution_function']['name'] }}</td>
                           <td>{{ date('d/m/Y', strtotime($data['solution_function']['created_at']))}}</td>
                           <td>
                                 <ul>
                                    @foreach($custommers as $user)
                                       <li>{{ $user->name }}</li>
                                    @endforeach
                                 </ul>
                           </td>
                     </tr>
                  </tbody>
         </table>
          <p>Do you start solving the problem with people?</p>
         @if($sol_loc_one_validation['validation_1'] == 1)
         <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I start solving the problem with people</div>
         @else
         <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I don’t start solving the problem with people</div>
         @endif

         <p>Do you finish solving the problem with the same people?</p>
          @if($sol_loc_one_validation['validation_2'] == 1)
            <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I finish solving the problem with the same people</div>
          @else
            <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I don’t finish solving the problem with the same people</div>
         @endif
      </section>
@endif
 <?php  $functionAud = $data['verification'][17]['functionAud']; ?>
      @if(!empty($functionAud))
         <section>
         
            <h2>Function Adjustment</h2>
            <p><strong>Improper Function:</strong> <span class="danger">{{ $functionAud->function_name }}</span></p>
            <p><strong>Problem Name:</strong> <span class="danger"> {{ $functionAud->problem_name }}</span></p>
            

         </section>
      @endif
<?php
          $problemreplaced_valid = $data['verification'][22]['validations'];
         
          ?>
      @if(!empty($problemreplaced_valid))
      <section>
          
         
         <h2>Replace Problem By Problem</h2>
         <p><strong>Problem:</strong> <span class="danger">{{  $data['problem']['name'] }}</span></p>
         <p><strong>Solution:</strong> <span class="success">{{ $data['solution']['name'] }}</span></p>
         <p>Does the solution of the problem is considered to be another problem?</p>
         @if($problemreplaced_valid['validation_1'] == 1)
         <div class="answer"><span class="yes">Yes</span>,  I understand that a problem needs to be solved</div>
         @else
         <div class="answer"><span class="yes">No</span>, I do not understand that a problem needs to be solved</div>
         @endif
      </section>
      @endif
      <?php
          $people = $data['verification'][19]['people'];
          $function_people_valid = $data['verification'][19]['validations'];
         ?>
      @if(!empty($function_people_valid))
      <section>
         <h2>Function Belong to People Verification</h2>
         
         <table>
                    <thead>
                        <th>Person Name</th>
                        <th>Function Name</th>
                        
                    </thead>
                    <tbody>
                       @foreach($people as $user)
                           @if($user->name != '')
                              <tr>
                                       <td>{{ $user->name }}</td>
                                       <td>{{ $data['solution_function']['name'] }}</td>
                              </tr>
                        @endif
                       @endforeach     
                    </tbody>
                </table>
                <p>Do I target the right function?</p>
               @if($function_people_valid['validation_1'] == 1)
               <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I target the right function</div>
               @else
               <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I don’t target the right function</div>
               @endif

               <p>Do I understand that I can only look at functions that belong to me when trying to solve a problem?</p>
               @if($function_people_valid['validation_2'] == 1)
                  <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I understand that I can only look at functions that belong to me when trying to solve a problem</div>
               @else
                  <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I don’t understand that I can only look at functions that belong to me when trying to solve a problem</div>
               @endif
      </section>
      @endif
       <?php 
               $problemPart  = $data['verification'][20]['problemPart'] ?? [];
               $problemPart_valid  = $data['verification'][20]['validations'];
               if(!empty($problemPart)){
               $solutionParts = \App\Models\AverageApproach::getSolutionParts($problemPart->project_id, $problemPart->id , $data['userID']);
               }
               
         ?>
      @if(!empty($problemPart_valid))
      <section>
         <h2>Averaging Approach Verification</h2>
         <h3>Part of Problem / Solution   </h3>
        

         <table>
            <thead>
               <tr>
                  <th>Part Of Problem </th>
                  <th>Part Of Solution </th>
               </tr>
            </thead>
            <tbody>
               @foreach($solutionParts as $key => $part)
                  <tr>
                        <td>Part {{ ++$key  }}</td>
                        <td>Part {{ $part->solution_part_value }}</td>
                  </tr>
                  @endforeach
            </tbody>
         </table>
         <p>Does the solution of that problem require averaging?</p>
            @if($problemPart_valid['validation_1'] == 1)
               <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the solution of that problem requires averaging</div>
               @else
               <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  the solution of that problem does not require averaging</div>
               @endif

               <p>Is each part of the problem substituted by a part of the solution?</p>
               @if($problemPart_valid['validation_2'] == 1)
                  <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>each part of the problem is substituted by a part of the solution</div>
               @else
                  <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  each part of the problem is not substituted by a part of the solution</div>
               @endif
      </section>
      @endif
       <?php
         $passive_voice_valid  = $data['verification'][21]['validations'];
         ?>
      @if(!empty($passive_voice_valid))
            <section>
               <h2>Passive Voice Approach Verification</h2>
            
               <table>
                  <thead>
                     <tr>
                        <th>Problem</th>
                        <th>Need</th>
                        <th>Solution</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>{{  $data['problem']['name'] }}</td>
                        <td>Needs to be</td>
                        <td>{{  $data['solution']['name'] }}</td>
                     </tr>
                  
                  </tbody>
               </table>
               <p><strong>Do you understand that a problem needs to be solved?</strong></p>
               @if($passive_voice_valid['validation_1'] == 1)
               <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I understand that a problem needs to be solved</div>
               @else
               <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>, I understand that a problem needs to be solved</div>
               @endif
            </section>
      @endif
<?php
         $me_vs_you_valid  = $data['verification'][28]['validations'];
         ?>
          @if(!empty($me_vs_you_valid))
      <section>
         <h2>Me Vs. You Approach Verification</h2>
          
         <table>
            <thead>
               <tr>
                  <th>Problem</th>
                  <th>Need</th>
                  <th>Solution</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>{{  $data['problem']['name'] }}</td>
                  <td>Needs</td>
                  <td>{{  $data['solution']['name'] }}</td>
               </tr>
              
            </tbody>
         </table>
          <p>Do I approach the solution of a problem one vs. another or people vs. people?</p>
            @if($me_vs_you_valid['validation_1'] == 1)
               <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, I approach the solution of a problem like me vs. you and people vs. people.</div>
               @else
               <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  I approach the solution of a problem like I work with you and people work together?</div>
               @endif

               <p>Do I understand that to solve a problem is I work with and I don’t go against? </p>
               @if($me_vs_you_valid['validation_2'] == 1)
                  <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span> I understand the solution of a problem is I work with and I don’t go against</div>
               @else
                  <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,   I do not understand the solution of a problem is I work with and I don’t go against</div>
               @endif
      </section>
     @endif
     <?php
         $problemLocation = $data['verification'][31]['problrmAtLocatios'];
         $problemLocationvalidations = $data['verification'][31]['validations'];
         ?>
      @if(!empty($problemLocationvalidations))
      <section>
         <h2>Problem at Location Verification</h2>
         
         <table>
            <thead>
               <tr>
                  <th>Problem</th>
                  <th>Location</th>
                  <th>Solution Function</th>
                  <th>Location</th>
               </tr>
            </thead>
            <tbody>
            <tr>
                  <td>{{  $data['problem']['name'] }}</td>
                  <td>{{ $problemLocation->problem_location }}</td>
                  <td>{{ $data['solution_function']['name'] }}</td>
                  <td>{{ $problemLocation->solution_function_location }}</td>
            </tr>
            </tbody>
         </table>
         <p>Is the problem solved at the location it is identified?</p>
            @if($problemLocationvalidations['validation_1'] == 1)
               <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>,  the problem is solved at the location it is identified</div>
               @else
               <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,  the problem is not solved at the location it is identified</div>
               @endif

               <p>Does the solution function of the problem execute at the problem location?</p>
               @if($problemLocationvalidations['validation_2'] == 1)
                  <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, the solution function of the problem executes at the problem’s location</div>
               @else
                  <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>,the solution function of the problem is not executed at the problem’s location</div>
               @endif
      </section>
      @endif
      @if($data['shared_project_data']['editable_relationship'] == 1)
      @include('adult.reports.component.relationship-report')
      @endif
   </div> 