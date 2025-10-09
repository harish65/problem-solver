 <?php
         $communications = $data['verification'][11]['communications'] ?? [];
         ?>
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