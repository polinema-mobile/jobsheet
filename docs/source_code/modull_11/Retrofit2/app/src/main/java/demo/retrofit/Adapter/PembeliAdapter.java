package demo.retrofit.Adapter;

import android.content.Intent;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

import java.util.List;

import demo.retrofit.Model.Pembeli;
import demo.retrofit.PutDelPembeliActivity;
import demo.retrofit.R;
import demo.retrofit.Rest.ApiClient;

/**
 * Created by alhamdulillah on 11/2/16.
 */
public class PembeliAdapter extends RecyclerView.Adapter<PembeliAdapter.PembViewHolder> {
    List<Pembeli> listPembeli;

    public PembeliAdapter(List<Pembeli> listPembeli) {
        this.listPembeli = listPembeli;
    }

    @Override
    public PembeliAdapter.PembViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_pembeli_layout, parent, false);
        PembViewHolder mHolder = new PembViewHolder(view);
        return mHolder;
    }

    @Override
    public void onBindViewHolder(PembeliAdapter.PembViewHolder holder, final int position) {


        holder.tvIdPembeli.setText(listPembeli.get(position).getIdPembeli());
        holder.tvNama.setText(listPembeli.get(position).getNama());
        holder.tvAlamat.setText(listPembeli.get(position).getAlamat());
        holder.tvTelpn.setText(listPembeli.get(position).getTelpn());
        if (listPembeli.get(position).getPhotoId().length()>0){
//            Picasso.with(holder.itemView.getContext()).load(ApiClient.BASE_URL+listPembeli.get(position).getPhotoId())
//                    .into(holder.mPhotoid);
            Glide.with(holder.itemView.getContext()).load(ApiClient.BASE_URL+listPembeli.get(position).getPhotoId())
                    .into(holder.mPhotoid);
        }else{
//          Picasso.with(holder.itemView.getContext()).load(R.drawable.photoid).into(holder.mPhotoid);
            Glide.with(holder.itemView.getContext()).load(R.drawable.photoid).into(holder.mPhotoid);
        }
        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(view.getContext(), PutDelPembeliActivity.class);
                intent.putExtra("id_pembeli",listPembeli.get(position).getIdPembeli());
                intent.putExtra("nama",listPembeli.get(position).getNama());
                intent.putExtra("alamat",listPembeli.get(position).getAlamat());
                intent.putExtra("telpn",listPembeli.get(position).getTelpn());
                intent.putExtra("photo_id",listPembeli.get(position).getPhotoId());
                view.getContext().startActivity(intent);
            }
        });
    }

    @Override
    public int getItemCount() {
        return listPembeli.size();
    }

    public class PembViewHolder extends RecyclerView.ViewHolder {
        ImageView mPhotoid;
        TextView tvIdPembeli, tvNama, tvAlamat, tvTelpn;

        public PembViewHolder(View itemView) {
            super(itemView);
            mPhotoid = (ImageView) itemView.findViewById(R.id.imgPembeli);
            tvIdPembeli = (TextView) itemView.findViewById(R.id.tvIdPembeli);
            tvNama = (TextView) itemView.findViewById(R.id.tvNama);
            tvAlamat = (TextView) itemView.findViewById(R.id.tvAlamatContent);
            tvTelpn = (TextView) itemView.findViewById(R.id.tvTelpnContent);
        }
    }
}
