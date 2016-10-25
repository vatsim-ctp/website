<table class="table voting-list">
    @foreach($airfields as $airfield)
        <tr {{ (Auth::user()->hasVotedFor($airfield->type) && Auth::user()->getVoteFor($airfield->type)->airfield_id == $airfield->id) ? "class=success" : "" }}>
            <td class="text-center col-md-4">
                <div class="voting-icao-iata">
                    <div class="voting-icao">{{ $airfield->icao }}</div>
                    <div class="voting-iata">{{ $airfield->iata }}</div>
                </div>
            </td>

            <td class="text-center col-md-4">
                @if(Auth::user()->hasVotedFor($airfield->type) && (Auth::user()->getVoteFor($airfield->type)->airfield_id == $airfield->id))
                    <span class='label label-success'>You voted for...</span><br />
                @endif

                {{ $airfield->name }}
            </td>

            @if(setting("voting", "show_results_before") || (!$canVote && setting("voting", "show_results_after")))
                <td class="text-center col-md-2">
                    {{ $airfield->votes->count() }}
                    <br />
                    {{ str_plural("vote", $airfield->votes->count()) }}
                </td>
            @endif

            @if($canVote)
                <td class="col-md-2">
                    {!! Form::open(["route" => ["voting.cast", $airfield->type, $airfield]]) !!}
                    <input type="submit" class="btn btn-primary btn-sm voting-vote" value="CAST VOTE" />
                    {!! Form::close() !!}
                </td>
            @endif
        </tr>
    @endforeach
</table>