package demo.retrofit.Model;

import com.google.gson.annotations.SerializedName;

/**
 * Created by alhamdulillah on 10/23/16.
 */

public class Pembelian {
    @SerializedName("id_pembelian")
    private String id_pembelian;
    @SerializedName("id_pembeli")
    private String id_pembeli;
    @SerializedName("tanggal_beli")
    private String tanggal_beli;
    @SerializedName("total_harga")
    private int total_harga;
    @SerializedName("id_tiket")
    private String id_tiket;

    public Pembelian() {}

    public Pembelian(String id_pembelian, String id_pembeli, String tanggal_beli, int total_harga, String id_tiket) {
        this.id_pembelian = id_pembelian;
        this.id_pembeli = id_pembeli;
        this.tanggal_beli = tanggal_beli;
        this.total_harga = total_harga;
        this.id_tiket = id_tiket;
    }

    public String getId_pembelian() {
        return id_pembelian;
    }

    public void setId_pembelian(String id_pembelian) {
        this.id_pembelian = id_pembelian;
    }

    public String getId_pembeli() {
        return id_pembeli;
    }

    public void setId_pembeli(String id_pembeli) {
        this.id_pembeli = id_pembeli;
    }

    public String getTanggal_beli() {
        return tanggal_beli;
    }

    public void setTanggal_beli(String tanggal_beli) {
        this.tanggal_beli = tanggal_beli;
    }

    public int getTotal_harga() {
        return total_harga;
    }

    public void setTotal_harga(int total_harga) {
        this.total_harga = total_harga;
    }

    public String getId_tiket() {
        return id_tiket;
    }

    public void setId_tiket(String id_tiket) {
        this.id_tiket = id_tiket;
    }
}
