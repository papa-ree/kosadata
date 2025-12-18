<?php

namespace Nawasara\Kosadata\Commands;

use Illuminate\Console\Command;
use Nawasara\Kosadata\Models\Desa;
use Nawasara\Kosadata\Models\Kecamatan;

class KosadataSeedCommand extends Command
{
    protected $signature = 'kosadata:seed';

    protected $description = 'Run database seeders from Kosadata package';

    public function handle(): int
    {
        $this->runSeeder();

        $this->info('Kosadata seeding completed.');
        return self::SUCCESS;
    }

    protected function runSeeder(): int
    {
        $this->seedKecamatanDesa();

        return self::SUCCESS;
    }

    public function seedKecamatanDesa()
    {
        $kecamatan = array(
            "Babadan" => array("Babadan", "Bareng", "Cekok", "Gupolo", "Japan", "Kadipaten", "Kertosari", "Lembah", "Ngunut", "Patihan Wetan", "Polorejo", "Pondok", "Purwosari", "Sukosari", "Trisono"),
            "Badegan" => array("Badegan", "Bandaralim", "Biting", "Dayakan", "Kapuran", "Karangan", "Karangjoho", "Tanjunggunung", "Tanjungrejo", "Watubonang"),
            "Balong" => array("Bajang", "Balong", "Bulak", "Bulukidul", "Dadapan", "Jalen", "Karangan", "Karangmojo", "Karangpatihan", "Muneng", "Ngampel", "Ngendut", "Ngraket", "Ngumpul", "Pandak", "Purworejo", "Sedarat", "Singkil", "Sumberejo", "Tatung"),
            "Bungkal" => array("Bancar", "Bedikulon", "Bediwetan", "Bekare", "Belang", "Bungkal", "Bungu", "Kalisat", "Ketonggo", "Koripan", "Kunti", "Kupuk", "Kwajon", "Munggu", "Nambak", "Padas", "Pager", "Pelem", "Sambilawang"),
            "Jambon" => array("Blembem", "Bringinan", "Bulu Lor", "Jambon", "Jonggol", "Karanglo Kidul", "Krebet", "Menang", "Poko", "Pulosari", "Sendang", "Sidoharjo", "Srandil"),
            "Jenangan" => array("Jenangan", "Jimbe", "Kemiri", "Mrican", "Nglayang", "Ngrupit", "Panjeng", "Paringan", "Pintu", "Plalangan", "Sedah", "Semanding", "Setono", "Singosaren", "Sraten", "Tanjungsari", "Wates"),
            "Jetis" => array("Coper", "Jetis", "Josari", "Karanggebang", "Kradenan", "Kutukulon", "Kutuwetan", "Mojomati", "Mojorejo", "Ngasinan", "Tegalsari", "Turi", "Winong", "Wonoketro"),
            "Kauman" => array("Bringin", "Carat", "Ciluk", "Gabel", "Kauman", "Maron", "Nglarangan", "Ngrandu", "Nongkodono", "Pengkol", "Plosojenar", "Semanding", "Somoroto", "Sukosari", "Tegalombo", "Tosanan"),
            "Mlarak" => array("Bajang", "Candi", "Gandu", "Gontor", "Jabung", "Joresan", "Kaponan", "Mlarak", "Ngrukem", "Nglumpang", "Serangan", "Siwalan", "Suren", "Totokan", "Tugu"),
            "Ngebel" => array("Gondowido", "Ngebel", "Ngrogung", "Pupus", "Sahang", "Sempu", "Talun", "Wagirlor"),
            "Ngrayun" => array("Baosankidul", "Baosanlor", "Binade", "Cepoko", "Gedangan", "Mrayan", "Ngrayun", "Selur", "Sendang", "Temon", "Wonodadi"),
            "Ponorogo" => array("Bangunsari", "Banyudono", "Beduri", "Brotonegaran", "Cokromenggalan", "Jingglong", "Kauman", "Keniten", "Kepatihan", "Mangkujayan", "Nologaten", "Paju", "Pakunden", "Pinggirsari", "Purbosuman", "Surodikraman", "Tamanarum", "Tambakbayan", "Tonatan"),
            "Pudak" => array("Banjarjo", "Bareng", "Krisik", "Pudakkulon", "Pudakwetan", "Tambang"),
            "Pulung" => array("Banaran", "Bedrug", "Bekiring", "Karangpatihan", "Kesugihan", "Munggung", "Patik", "Plunturan", "Pomahan", "Pulung", "Pulung Merdiko", "Serag", "Sidoharjo", "Singgahan", "Tegalrejo", "Wagirkidul", "Wayang", "Wotan"),
            "Sambit" => array("Bancangan", "Bangsalan", "Bedingin", "Besuki", "Bulu", "Campurejo", "Campursari", "Gajah", "Jrakah", "Kemuning", "Maguwan", "Ngadisanan", "Nglewan", "Sambit", "Wilangan", "Wringinanom"),
            "Sampung" => array("Carangrejo", "Gelangkulon", "Glinggang", "Jenangan", "Karangwaluh", "Kunti", "Nglurup", "Pagerukir", "Pohijo", "Ringinputih", "Sampung", "Tulung"),
            "Sawoo" => array("Bondrang", "Grogol", "Ketro", "Kori", "Ngindeng", "Pangkal", "Prayungan", "Sawoo", "Sriti", "Temon", "Tempuran", "Tugurejo", "Tumpakpelem", "Tumpuk"),
            "Siman" => array("Beton", "Brahu", "Demangan", "Jarak", "Kepuhrubuh", "Madusari", "Mangunsuman", "Manuk", "Ngabar", "Patihan Kidul", "Pijeran", "Ronosentanan", "Ronowijayan", "Sawuh", "Sekaran", "Siman", "Tajug", "Tranjang"),
            "Slahung" => array("Broto", "Caluk", "Crabak", "Duri", "Galak", "Gombang", "Gundik", "Janti", "Jebeng", "Kambeng", "Menggare", "Mojopitu", "Nailan", "Ngilo-ilo", "Ngloning", "Plancungan", "Senepo", "Simo", "Slahung", "Truneng", "Tugurejo", "Wates"),
            "Sooko" => array("Bedoho", "Jurug", "Klepu", "Ngadirojo", "Sooko", "Suru"),
            "Sukorejo" => array("Bangunrejo", "Gandukepuh", "Gegeran", "Gelanglor", "Golan", "Kalimalang", "Karanglolor", "Kedungbanteng", "Kranggan", "Lengkong", "Morosari", "Nambangrejo", "Nampan", "Prajegan", "Serangan", "Sidorejo", "Sragi", "Sukorejo")
        );

        foreach ($kecamatan as $nama_kec => $array_desa) {
            $kecamatan = Kecamatan::create([
                'name' => $nama_kec,

            ]);
            foreach ($array_desa as $nama_desa) {
                Desa::create([
                    'kecamatan_id' => $kecamatan->id,
                    'name' => $nama_desa,
                ]);
            }
        }
    }
}