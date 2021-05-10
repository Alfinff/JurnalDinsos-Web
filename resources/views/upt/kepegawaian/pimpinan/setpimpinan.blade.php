<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table>
				<tr>
					<td>Nama Unit</td>
					<td>&nbsp;&nbsp;&nbsp;:&nbsp; {{$unitkerja->nama_unit_kerja}}</td>
				</tr>
				<tr>
					<td>Kode Unit</td>
					<td>&nbsp;&nbsp;&nbsp;:&nbsp; {{$unitkerja->kode_surat_unit_kerja}}</td>
				</tr>
				<tr>
					<td>Nama Pimpinan</td>
					<td>&nbsp;&nbsp;&nbsp;:
						<select name="users_id" id="users_id" required>
							<option value="" selected disabled>Pilih Nama Pegawai</option>
                            @foreach ($pegawai as $p)
                                <option value="{{$p->uuid}}">{{ucwords($p->username)}}</option>
                            @endforeach
						</select>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
