<?php

namespace CTP\Http\Controllers\Api;

use CTP\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Status extends BaseController
{
    private function returnStatus($status, $verbose, $extra = [])
    {
        return response()->json(array_merge([
            'status' => $status,
            'verbose' => $verbose,
        ], $extra));
    }

    public function getStatus(Request $request)
    {
        if (voting_available()) {
            $votingClose = setting('voting', 'close');

            if ($votingClose instanceof \Carbon\Carbon && $votingClose->gt(\Carbon\Carbon::now())) {
                $diff = \Carbon\Carbon::now()->diff($votingClose);

                $verbose = 'Voting closes in ';
                $verbose .= ($diff->m > 0) ? $diff->m.' '.str_plural('month', $diff->m).', ' : '';
                $verbose .= ($diff->d > 0) ? $diff->d.' '.str_plural('day', $diff->d).', ' : '';
                $verbose .= ($diff->h > 0) ? $diff->h.' '.str_plural('hour', $diff->h).', ' : '';
                $verbose .= ($diff->i > 0) ? $diff->i.' '.str_plural('minute', $diff->i).', ' : '';
                $verbose .= ($diff->s > 0) ? $diff->s.' '.str_plural('second', $diff->s).', ' : '';

                return $this->returnStatus('voting', rtrim($verbose, ', '), [
                    'timestamp' => $votingClose->toDateTimeString(),
                    'timestamp_diff' => $votingClose->diffInSeconds(\Carbon\Carbon::now(), false),
                ]);
            }

            return $this->returnStatus('voting', 'Voting is open now!');
        }

        $votingOpen = setting('voting', 'open');
        if ($votingOpen instanceof \Carbon\Carbon && $votingOpen->gt(\Carbon\Carbon::now())) {
            $diff = \Carbon\Carbon::now()->diff($votingOpen);

            $verbose = 'Voting starts in ';
            $verbose .= ($diff->m > 0) ? $diff->m.' '.str_plural('month', $diff->m).', ' : '';
            $verbose .= ($diff->d > 0) ? $diff->d.' '.str_plural('day', $diff->d).', ' : '';
            $verbose .= ($diff->h > 0) ? $diff->h.' '.str_plural('hour', $diff->h).', ' : '';
            $verbose .= ($diff->i > 0) ? $diff->i.' '.str_plural('minute', $diff->i).', ' : '';
            $verbose .= ($diff->s > 0) ? $diff->s.' '.str_plural('second', $diff->s).', ' : '';

            return $this->returnStatus('voting_countdown', rtrim($verbose, ', '), [
                'timestamp' => $votingOpen->toDateTimeString(),
                'timestamp_diff' => $votingOpen->diffInSeconds(\Carbon\Carbon::now(), false),
            ]);
        }

        return $this->returnStatus('planning', "We're busy planning ".setting('event', 'name'));
    }
}
