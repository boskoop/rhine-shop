{{--
    admin_users.blade.php

    Variables needed:
    - users -> the users
--}}
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>E-Mail</th>
                  <th>Address</th>
                  <th style="width: 20px; padding-left: 0px; padding-right: 0px"></th>
                </tr>
              </thead>
              <tbody>
@foreach($users as $listuser)
                <tr>
                  <td>{{ $listuser->id }}</td>
                  <td>{{ $listuser->username }}</td>
                  <td>{{ $listuser->email }}</td>
                  <td><?php $address = $listuser->address()->first(); ?>
                    <address style="margin-bottom: 0">
                      {{ __('rhine/account.title_'.$address->gender->gender) }} {{ $address->forename }} {{ $address->surname }}<br>
                      
@if($address->street2 == null)
                      {{ $address->street1 }}<br>
@else
                      {{ $address->street1 }}, {{ $address->street2 }}<br>
@endif
                      {{ $address->zip }} {{ $address->city }} {{ $address->country }}
                    </address>
                  </td>
                  <td>
@if($listuser->isAdmin())
                    <span class="label label-info">Admin</span>
@else
                    {{ Form::open(URL::to_route('deleteuser', array($listuser->id)), 'POST', array('class' => 'form-inline', 'style' => 'margin-bottom: 0')) }}

                      <button href="#confirm-delete-user-{{ $listuser->id }}" type="button" data-toggle="modal" class="btn btn-mini btn-danger"><i class="icon-remove-sign icon-white" ></i></button>
                      <div id="confirm-delete-user-{{ $listuser->id }}" class="modal hide fade" style="text-align: left">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h3>Confirm</h3>
                        </div>
                        <div class="modal-body">
                          <p>All data (address, orders) of the user will be deleted!</p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger"><i class="icon-remove-sign icon-white" ></i> Delete user</button>
                          <a href="#confirm-delete-user-{{ $listuser->id }}" role="button" class="btn" data-toggle="modal">Cancel</a>
                        </div>
                      </div>
                      {{ Form::token() }}

                    {{ Form::close() }}

@endif
                  </td>
                </tr>
@endforeach
              </tbody>
            </table>
