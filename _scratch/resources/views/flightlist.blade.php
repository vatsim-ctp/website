@extends('layout')

@section("content")
<div class="col-md-12">
    <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
            <tr>
                <th>CTOT</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Min FL</th>
                <th>Max FL</th>
                <th>Book</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1100 <span class="label label-danger">Suggested Concorde route</span></td>
                <td>London Heathrow (EGLL)</td>
                <td>Boston Logan (KBOS)</td>
                <td>310</td>
                <td>350</td>
                <td><button class="btn btn-green label">Book now</button></td>
            </tr>
            <tr>
                <td>1102 <span class="label label-danger">Suggested Concorde route</span></td>
                <td>London Heathrow (EGLL)</td>
                <td>Washing Dulles (KXXX)</td>
                <td>310</td>
                <td>350</td>
                <td><button class="btn btn-green label">Book now</button></td>
            </tr>
            <tr>
                <td>1102 <span class="label label-danger">Suggested Concorde route</span></td>
                <td>London Heathrow (EGLL)</td>
                <td>Chicago O'Hare</td>
                <td>330</td>
                <td>370</td>
                <td><button class="btn btn-green label">Book now</button></td>
            </tr>
            <tr>
                <td>1104 <span class="label label-danger">Suggested Concorde route</span></td>
                <td>London Heathrow (EGLL)</td>
                <td>Boston Logan (KBOS)</td>
                <td>310</td>
                <td>350</td>
                <td><span class='label label-danger'>Taken</span></td>
            </tr>
            <tr>
                <td>1105</td>
                <td>London Gatwick (EGKK)</td>
                <td>Washing Dulles (KXXX)</td>
                <td>290</td>
                <td>310</td>
                <td><button class="btn btn-green label">Book now</button></td>
            </tr>
            <tr>
                <td>1108</td>
                <td>London Gatwick (EGKK)</td>
                <td>Boston Logan (KBOS)</td>
                <td>310</td>
                <td>330</td>
                <td><span class='label label-danger'>Taken</span></td>
            </tr>
            <tr>
                <td>1110</td>
                <td>London Gatwick (EGKK)</td>
                <td>Washing Dulles (KXXX)</td>
                <td>330</td>
                <td>350</td>
                <td><button class="btn btn-green label">Book now</button></td>
            </tr>
            <tr>
                <td>1112</td>
                <td>London Gatwick (EGKK)</td>
                <td>Boston Logan (KBOS)</td>
                <td>310</td>
                <td>350</td>
                <td><span class='label label-danger'>Taken</span></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Please note that all times are UTC.  You will be allocated your final flight level, along with your route, up to 6 hours prior to the event start.</td>
            </tr>
        </tfoot>
    </table>
</div>
@overwrite