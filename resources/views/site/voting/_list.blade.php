<table class="voting-list">
    @foreach($airfields as $airfield)
        <tr>
            <td>
                <div class="voting-icao-iata">
                    <div class="voting-icao">{{ $airfield->icao }}</div>
                    <div class="voting-iata">{{ $airfield->iata }}</div>
                </div>
            </td>

            <td>
                {{ $airfield->name }}
            </td>

            @if($setting_voting_show_results_before || (!$canVote && $setting_voting_show_results_after))
                <td align="center">
                    {{ $airfield->votes->count() }}

                    @if($canVote)
                        <br />
                        {{ str_plural("vote", $airfield->votes->count()) }}
                    @endif
                </td>
            @endif

            @if($canVote)
                <td>
                    {!! Form::open(["route" => ["voting.cast", $airfield->type, $airfield]]) !!}
                    <input type="submit" class="btn btn-primary btn-sm voting-vote" value="CAST VOTE" />
                    {!! Form::close() !!}
                </td>
            @endif
        </tr>
    @endforeach
</table>