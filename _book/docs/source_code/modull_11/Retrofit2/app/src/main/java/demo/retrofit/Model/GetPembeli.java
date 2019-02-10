package demo.retrofit.Model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by alhamdulillah on 11/2/16.
 */

public class GetPembeli {
    @SerializedName("status")
    @Expose
    private String status;
    @SerializedName("result")
    @Expose
    private List<Pembeli> result = new ArrayList<Pembeli>();
    @SerializedName("message")
    private String message;
    public GetPembeli() {}

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public List<Pembeli> getResult() {
        return result;
    }

    public void setResult(List<Pembeli> result) {
        this.result = result;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }
}
