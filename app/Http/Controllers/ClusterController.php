<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Resep;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Cluster',
            'cluster' => Cluster::where('void', 0)->get(),
        ];
        return view('cluster.index', $data);
    }

    public function addCluster(Request $request)
    {

        $cek = Cluster::where('nm_cluster', $request->nm_cluster)->where('void', 0)->first();

        if ($cek) {
            return redirect()->back()->with('error', 'Cluster sudah ada');
        } else {
            $data = [
                'nm_cluster' => $request->nm_cluster,
                'takaran1' => $request->takaran1,
                'takaran2' => $request->takaran2,
            ];
            Cluster::create($data);
            return redirect()->back()->with('success', 'Data berhasil dibuat');
        }
    }

    public function editCluster(Request $request)
    {
        $cek = Cluster::where('id', '!=', $request->id)->where('nm_cluster', $request->nm_cluster)->where('void', 0)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Cluster sudah ada');
        } else {
            $data = [
                'nm_cluster' => $request->nm_cluster,
                'takaran1' => $request->takaran1,
                'takaran2' => $request->takaran2,
            ];
            Cluster::where('id', $request->id)->update($data);

            Resep::where('cluster_id', $request->id)->update([
                'takaran1' => $request->takaran1,
                'takaran2' => $request->takaran2,
            ]);


            return redirect()->back()->with('success', 'Data berhasil diubah');
        }
    }

    public function deleteCluster($id)
    {
        $data = [
            'void' => 1
        ];

        Cluster::where('id', $id)->update($data);

        Resep::where('cluster_id', $id)->update($data);

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
