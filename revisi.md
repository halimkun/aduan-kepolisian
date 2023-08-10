[x] 1. ganti keterangan mjd kronologi kejadian (bagian form tambah aduan)
[x] 2. jenis aduan sesuai wawancara (penipuan, perampokan, penganiayaan, pencurian, pemerasan, judi, kecelakaan)
[x] 3. tambahkan tanggal periodik untuk daftar laporan (ben iso cetak laporan dari tgl 1-20 juli)
[x] 4. tambahkan kop kepolisian
[x] 5. tambahkan yg mengetahui di dalam cetak laporan
[x] 6. tambahkan keterangan pd status misal status dalam proses(ket : peninjauan ke lokasi)
[x] 7. admin tambahkan tabel jenis aduan supaya bisa menambahkan jenis aduan melalui gui
[ ] 8. tambahkan gps



# 1
perubahan keterangan tidak bisa sampai pada perubahan di database, karena hal tersebut dapat menyebabkan crash pada aplikasi yang sudah berjalan. sehingga perubahan hanya dapat dilakukan pada bagian view saja. perubahan mungkin untuk dilakukan jika waktu yang tersedia cukup banyak, sehingga dapat dilakukan perubahan pada bagian model dan controller serta database.

# 6
Keterangan dalam status tidak perlu di tambahkan, karena bisa diwakilkan langsung oleh statusnya. misal status dalam proses, maka status tersebut dapat diwakilkan dengan peninjauan ke lokasi. sehingga tidak perlu menambahkan keterangan pada status. keterangan pada status hanya akan mempersulit penggunaan aplikasi, karena dalam satu status memungkinkan untuk memiliki banyak keterangan. sehingga akan membingungkan pengguna dalam memilih keterangan yang sesuai dengan statusnya. 

misalnya dalam status dalam proses, terdapat keterangan peninjauan ke lokasi, menindak lanjuti, dan lain-lain. jadi keterangan pada status tidak perlu ditambahkan, karena dapat diwakilkan langsung oleh statusnya.

# 8 
terkenda masalah pada penggunaan gps, sehingga belum dapat diimplementasikan pada aplikasi. untuk sementara fitur ini belum dapa