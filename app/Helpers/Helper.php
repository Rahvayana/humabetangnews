<?php

namespace App\Helpers;

use App\Advertisement;
use Pusher\Pusher;

class Helper
{
	public static function testHelpeer()
	{

		return "NICE";
	}

	public static function edit($link = '')
	{

			echo '<a class="dropdown-item" href="' . URL($link) . '">
							<i class="fa fa-edit" style="color:blue"></i>&nbsp; Edit
						</a>';

	}

	public static function baca($link = '')
	{

			echo '<a class="dropdown-item" href="' . URL($link) . '">
							<i class="fa fa-folder-open" style="color:orange"></i>&nbsp; View
						</a>';

	}


	public static function batal($link = '', $label = '')
	{

			echo '<a href="#" class="waves-effect waves-light btn red showModalBatal tooltipped" data-position="bottom" data-delay="50" data-tooltip="Batal" data-link="' . URL($link) . '" data-name="' . $label . '">
								<i class="fa fa-times-circle" style="color:red"></i>&nbsp; '. $label .'
							</a>';

	}


	public static function hapus($link = '', $label = '')
	{

			echo '<a href="#" class="dropdown-item showModalHapus tooltipped" data-position="bottom" data-delay="50" data-tooltip="Hapus" data-link="' . URL($link) . '" data-name="' . $label . '">
								<i class="fa fa-trash" style="color:red"></i>&nbsp; Delete
							</a>';

	}

	public static function tambah($link = '')
	{

			echo '<a class="dropdown-item" href="' . URL($link) . '" title="Add" data-rel="tooltip">
						<i class="fa fa-plus" tyle="color:green">&nbsp; Add</i>
					</a>
				';

	}

	public static function ubahDBKeTanggalwaktu($tanggal = '')
	{
		$tanggal_waktu = SELF::ubahDBKeTanggal(date('Y-m-d', strtotime($tanggal))) . ' ' . date('H:i:s', strtotime($tanggal));
		return $tanggal_waktu;
	}

	public static function ubahTanggalwaktuKeDB($tanggal = '')
	{
		$pecah_tanggal 		= explode(' ', $tanggal);
		$tanggal 			= $pecah_tanggal[0] . ' ' . $pecah_tanggal[1] . ' ' . $pecah_tanggal[2];
		$waktu 				= $pecah_tanggal[3];
		$tanggal_waktu 		= SELF::ubahTanggalKeDB($tanggal) . ' ' . $waktu;
		return $tanggal_waktu;
	}

	public static function ubahDBKeTanggal($tanggal = '')
		{
			$data_bulan 	= array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
			$pecah_tanggal	= explode('-', $tanggal);
			$bulan 			= '';
			if ($tanggal != '0000-00-00') {
				for ($x = 1; $x <= 12; $x++) {
					if (intval($pecah_tanggal[1]) == $x) {
						$bulan = $x;
						break;
					}
				}
				return $pecah_tanggal[2] . ' ' . $data_bulan[$bulan] . ' ' . $pecah_tanggal[0];
			} else
				return SELF::ubahDBKeTanggal(date('Y-m-d'));
		}

		public static function ubahTanggalKeDB($tanggal = '')
		{
			if ($tanggal != '') {
				$data_bulan 	= array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
				$pecah_tanggal  	= explode(' ', $tanggal);
				$bulan 				= '';
				for ($x = 1; $x <= 12; $x++) {
					if ($pecah_tanggal[1] == $data_bulan[$x]) {
						$bulan = $x;
						break;
					}
				}
				if ($bulan < 10)
					$bulan = '0' . $bulan;

				$result = $pecah_tanggal[2] . '-' . $bulan . '-' . $pecah_tanggal[0];
				return $result;
			} else
				return '';
		}

	public static function getYoutubeImgFromURL($url){
        $video_id = explode("?v=", $url);
        $video_id = $video_id[1];
		$thumbnail="http://img.youtube.com/vi/".$video_id."/mqdefault.jpg";

		return $thumbnail;
	}

	public static function getYoutubeVideoID($url){
        $video_id = explode("?v=", $url);
        $video_id = $video_id[1];


		return $video_id;
	}

	public static function dateTimePickerToDB($date)
	{

		// return $time;
		if ($date == null) {
			$now = date('Y-m-d H:i:s');
		} else {
			$now = $date;
		}

		return date('Y-m-d H:i:s', strtotime($now));
    }

    public static function strRandom($length = 32)
	{
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public static function getAds(){
        $count = Advertisement::where('ads_status_delete', 0)->where('ads_status_web', 1)->count();

        if($count > 1){
            $ads = Advertisement::where('ads_status_delete', 0)->where('ads_status_web', 1)->get()->random();
        }else{
            $ads = Advertisement::where('ads_status_delete', 0)->where('ads_status_web', 1)->first();
        }

        return $ads;
    }

    public static function initPusher(){
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
          );
          $pusher = new Pusher(
            'cb071e8da9c0805e31e0',
            'f932c853d3474a5b0cab',
            '1049471',
            $options
          );

          return $pusher;
    }

}
