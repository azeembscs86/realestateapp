@extends('admin.layouts.default.start-minified')
@section('contents')
<?php
  function forhtml($a){return $a;}
  ?>
<a href="{{url('admin/dashboard')}}"><span aria-hidden="true">&larr;</span> Back to admin dashboard!</a>
<style>
/*.self-set-table tbody tr td{ padding:10px 8px !important; }*/
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, 
.table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
  padding: 8px;
  vertical-align: inherit;
}
</style>
<div class="container">
<table border="0" align="center" width="100%" class="self-set-table">
  <tr>
    <td colspan="4" align="center" valign="top">
      <table class="table table-striped table-bordered table-hover self-set-table">
        <thead>
          <tr>
            <th colspan="<?= $monthtotaldays + 1 ?>" bgcolor="#999999" style="color:#FFFFFF">
              <h3 class="text-center">
                <?php
                  echo date('F, Y', strtotime($year . '-' . $month . '-1'));
                  ?>
              </h3>
            </th>
          </tr>
          <tr>
            <th></th>
            <?php
              for ($d = 1; $d <= $monthtotaldays; $d++) {
              ?>
            <th> <strong>
              <?= ($d > 9) ? $d : '0' . $d ?>
              </strong> 
            </th>
            <?php
              } //$d = 1; $d <= $monthtotaldays; $d++
              ?>
          </tr>
        </thead>
        <?php
          foreach ($properties as $property) {
          
          ?>
        <tr>
          <td>
            <h4 style="font-size:14px;">
              <?= forhtml($property->title) ?>
            </h4>
          </td>
          <?php
            for ($d = 1; $d <= $monthtotaldays; $d++) {
            ?>
          <?php
            $date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $d));
            
            if (!isset($dates_reserved[$property->id]['date_'.date('Ymd', strtotime($date))])) {
            
            
              if (date('Ymd') >= date('Ymd', strtotime($date))) {
            ?>
          <td></td>
          <?php
            } //date( 'Ymd' ) >= date( 'Ymd', strtotime( $date ) )
            else {
            
            ?>
          <td rel="{{url('admin/reservations/create/'.$property->slug.'/'.$date)}}" 
            class="date-available make-modal-large iframe-form-open" 
            data-toggle="modal" data-target="#iframeModal" title="Add Reservation - <?= date('m/d/Y',strtotime($date)) ?> - <?=forhtml($property->title)?>" ><small><span class="glyphicon glyphicon-plus-sign"></span></small></td>
          <?php
            }
            } //mysql_num_rows( $resultR ) == '0'
            else {
            
                $reservation_id = $dates_reserved[$property->id]['date_'.date('Ymd', strtotime($date))]['reservation_id'];
                $status = $dates_reserved[$property->id]['date_'.date('Ymd', strtotime($date))]['status'];
                $firstname = $dates_reserved[$property->id]['date_'.date('Ymd', strtotime($date))]['firstname'];
                $lastname = $dates_reserved[$property->id]['date_'.date('Ymd', strtotime($date))]['lastname'];
                $reservation_total_days = $dates_reserved[$property->id]['date_'.date('Ymd', strtotime($date))]['reservation_total_days'];
            
                ?>
          <td rel="{{url('admin/reservations/edit/'.$reservation_id)}}" class="date-<?= $status ?> <?= @$class ?> make-modal-large iframe-form-open cursor-pointer" data-toggle="modal" data-target="#iframeModal" title="Edit Reservation - <?= $firstname . ' ' . $lastname?>"  colspan="<?= $reservation_total_days ?>">
            <?= $firstname . ' ' . $lastname?>
          </td>
          <?php
            $d += $reservation_total_days - 1;
            unset($class);
            
            
            }
            ?>
          <?php
            } //$d = 1; $d <= $monthtotaldays; $d++
            ?>
        </tr>
        <?php
          } //$rowP = mysql_fetch_array( $resultP )
          ?>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="4">
      <hr />
    </td>
  </tr>
  <tr>
    <td align="center" valign="bottom">
      <a href="{{url('/admin/calendar-view/'.$calendarPreviousYear.'/'.$calendarPreviousMonth)}}" >
        <div id="calendar-arrow-left"></div>
      </a>
    </td>
    <td width="15-" align="center" valign="bottom">
      <table border="0" class="self-set-table">
        <tr>
          <td width="70" align="left">Booked</td>
          <td width="20" bgcolor="#ff0000" style="border:#000000 solid 1px;">&nbsp;</td>
        </tr>
      </table>
      <br>
      <table border="0" class="self-set-table">
        <tr>
          <td width="70" align="left">Owner</td>
          <td width="20" bgcolor="#777777" style="border:#000000 solid 1px;">&nbsp;</td>
        </tr>
      </table>
    </td>
    <td width="150" align="center" valign="bottom">
      <table border="0" class="self-set-table">
        <tr>
          <td width="20" bgcolor="#ffff00" style="border:#000000 solid 1px;">&nbsp;</td>
          <td width="70" align="right">Pending</td>
        </tr>
      </table>
      <br>
      <table border="0" class="self-set-table">
        <tr>
          <td width="20" bgcolor="#ffffff" style="border:#000000 solid 1px;">&nbsp;</td>
          <td width="70" align="right">Available</td>
        </tr>
      </table>
    </td>
    <td align="center" valign="bottom" class="self-set-table">
      <a href="{{url('/admin/calendar-view/'.$calendarNextYear.'/'.$calendarNextMonth)}}">
        <div id="calendar-arrow-right"></div>
      </a>
    </td>
  </tr>
</table>
<div class="modal fade responsive" id="iframeModal" tabindex="-1" role="dialog" aria-labelledby="iframeModalLabel" aria-hidden="true">
  <div class="ajax-spinner-center modal-center-spinner">
    <!--Shown in the center of modal window while contents are being loaded through ajax call-->
  </div>
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close ajax-form-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="iframeModalLabel">Add/Edit</h4>
      </div>
      <div class="modal-body">
        <div id="iframe-form-response">
          <!--Ajax Form Submit Results Here-->
        </div>
        <iframe name="iFrame" src="" style="zoom:1" width="100%" height="500" frameborder="0"></iframe>
      </div>
    </div>
  </div>
</div>

</div>
<nav>
  <ul class="pager">
    <li><a href="{{url('/admin/dashboard')}}"><span aria-hidden="true">&larr;</span> Back to admin</a></li>
  </ul>
</nav>
@endsection
