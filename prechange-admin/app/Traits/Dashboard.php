<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\Models\UserWallet;
use App\Models\AdminWallet;
use DB;

trait Dashboard
{
	public function totalInvestment($currency)
	{
		$total = UserWallet::on('mysql2')->where('currency',$currency)->sum(DB::raw('balance + escrow_balance'));

		if($currency == 'ETH' || $currency == 'XRP')
		{
			$eth = $this->convertToBtc($total,'ETH');
			
			if($currency == 'XRP')
			{
				$final = 0.00075 * $total * $eth;
			}
			else
			{
				$final = $total * $eth;
			}
		}
		elseif($currency == 'BTC')
		{
			$final = $total;
		}

		return $final;
	}

	public function siteUserBalance()
	{
		$btc = $this->totalInvestment('BTC');
		$eth = $this->totalInvestment('ETH');
		$xrp = $this->totalInvestment('XRP');

		return array(
			'BTC' => round($btc,2),
			'ETH' => round($eth,2),
			'XRP' => round($xrp,3)
			);
	}

	public function income()
	{
		return array(
			'BTC' => $this->adminIncome('BTC'),
			'ETH' => $this->adminIncome('ETH'),
			'XRP' => $this->adminIncome('XRP')
			);
	}

	public function adminIncome($coin)
	{
		$total = AdminWallet::on('mysql2')->where('currency',$coin)->sum(DB::raw('commission + withdraw'));

		return $total;
	}

	public function convertToBtc($total,$currency)
	{
		$url = "https://api.coinmarketcap.com/v2/ticker/?convert=$currency";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		if (curl_errno($ch)) {
			$result = 'Error:' . curl_error($ch);
		} else {
			$result = curl_exec($ch);
		}
		$result = json_decode($result, true); 
		$final = $result['data'][1]['quotes']['ETH']['price'];
		return number_format(1/$final,3,'.','');
	}

	
}