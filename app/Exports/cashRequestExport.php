<?php

namespace App\Exports;

use App\Models\cashoutRequest;
use App\Models\da_info;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class cashRequestExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
            $items = cashoutRequest::selectRaw('cashout_requests.code as code,

	users.name as name,
	(
	SELECT
		SUM( items.amount )
	FROM
		payments
		LEFT JOIN items ON payments.item_id = items.id
	WHERE
		cashout_id IS NULL
		AND items.seller_id = cashout_requests.seller_id
	) AS amount,
	cashout_requests.date as date,
	cashout_statuses.`status`
	')
                ->leftJoin('users', 'cashout_requests.seller_id', '=', 'users.id')
                ->leftJoin('cashout_statuses', 'cashout_requests.status','cashout_statuses.id')->orderBy('cashout_requests.id','DESC');
            if (auth()->user()->hasRole('da')) {
                $da_loc = da_info::where('da_id', Auth::id())->firstOrFail()->location_id;
                $items = $items->where('users.location_id', '=', $da_loc);
            } elseif (auth()->user()->hasRole('seller')){
                $items = $items->where('cashout_requests.seller_id', '=', auth()->id());
            }
            return $items->get();
    }

    public function headings(): array
    {
        return ['Code','Name','Amount','Date','Status'];
    }
}
