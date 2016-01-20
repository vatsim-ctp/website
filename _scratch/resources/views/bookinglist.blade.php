@extends('layout')

@section("title")
All Booked Flights
@overwrite

@section("content")
<div class="col-md-12">
    <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
            <tr>
                <th>Callsign</th>
                <th>CTOT</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Status</th>
                <th>Pilot</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{!! Html::image("assets/airline_logos/BAW.png") !!} BAW0001</td>
                <td>1100</td>
                <td>London Heathrow (EGLL)</td>
                <td>Boston Logan (KBOS)</td>
                <td><span class="label label-default">Not Connected</span></td>
                <td>
                    {!! link_to("#", "Anthony Lawrence (980234)") !!}
                </td>
            </tr>
            <tr>
                <td>{!! Html::image("assets/airline_logos/BAW.png") !!} BAW0819</td>
                <td>1102</td>
                <td>London Heathrow (EGLL)</td>
                <td>Washing Dulles (KXXX)</td>
                <td><span class="label label-info">On Stand</span></td>
                <td>
                    {!! link_to("#", "Anthony Lawrence (980234)") !!}
                    &nbsp;&nbsp;
                    {!! link_to("#", "Live Stream", ["class" => "label label-primary"]) !!}
                </td>
            </tr>
            <tr>
                <td>{!! Html::image("assets/airline_logos/TOM.png") !!} TOM982T</td>
                <td>1102</td>
                <td>London Heathrow (EGLL)</td>
                <td>Chicago O'Hare</td>
                <td><span class="label label-success">Departing</span></td>
                <td>
                    {!! link_to("#", "Anthony Lawrence (980234)") !!}
                </td>
            </tr>
            <tr>
                <td>{!! Html::image("assets/airline_logos/EZY.png") !!} EZY991A</td>
                <td>1104</td>
                <td>London Heathrow (EGLL)</td>
                <td>Boston Logan (KBOS)</td>
                <td><span class="label label-primary">Cruise</span></td>
                <td>
                    {!! link_to("#", "Anthony Lawrence (980234)") !!}
                </td>
            </tr>
            <tr>
                <td>{!! Html::image("assets/airline_logos/DHL.png") !!} DHL34SD</td>
                <td>1105</td>
                <td>London Heathrow (EGLL)</td>
                <td>Washing Dulles (KXXX)</td>
                <td><span class="label label-warning">Arriving</span></td>
                <td>
                    {!! link_to("#", "Anthony Lawrence (980234)") !!}
                    &nbsp;&nbsp;
                    {!! link_to("#", "Live Stream", ["class" => "label label-primary"]) !!}
                </td>
            </tr>
            <tr>
                <td>{!! Html::image("assets/airline_logos/UPS.png") !!} UPS0857</td>
                <td>1108</td>
                <td>London Heathrow (EGLL)</td>
                <td>Boston Logan (KBOS)</td>
                <td><span class="label label-default">Not Connected</span></td>
                <td>
                    {!! link_to("#", "Anthony Lawrence (980234)") !!}
                </td>
            </tr>
            <tr>
                <td>{!! Html::image("assets/airline_logos/UAL.png") !!} UAL1234</td>
                <td>1110</td>
                <td>London Heathrow (EGLL)</td>
                <td>Washing Dulles (KXXX)</td>
                <td><span class="label label-default">Not Connected</span></td>
                <td>
                    {!! link_to("#", "Anthony Lawrence (980234)") !!}
                </td>
            </tr>
            <tr>
                <td>{!! Html::image("assets/airline_logos/AAL.png") !!} AAL0001</td>
                <td>1112</td>
                <td>London Heathrow (EGLL)</td>
                <td>Boston Logan (KBOS)</td>
                <td><span class="label label-danger">Arrived</span></td>
                <td>
                    {!! link_to("#", "Anthony Lawrence (980234)") !!}
                    &nbsp;&nbsp;
                    {!! link_to("#", "Live Stream", ["class" => "label label-primary"]) !!}
                </td>
            </tr>
        </tbody>
    </table>
</div>
@overwrite