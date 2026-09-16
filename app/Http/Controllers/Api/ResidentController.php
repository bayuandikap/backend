<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResidentRequest;
use App\Http\Requests\UpdateResidentRequest;
use App\Http\Resources\ResidentResource;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::query();

        $query->when(
            $request->search,
            function ($q, $search) {

                $q->where(function ($query) use ($search) {

                    $query
                        ->where(
                            'name',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'nik',
                            'like',
                            "%{$search}%"
                        );
                });
            }
        );

        $query->when(
            $request->gender,
            function ($q, $gender) {

                $q->where(
                    'gender',
                    $gender
                );
            }
        );

        $query->when(
            $request->resident_status,
            function ($q, $status) {

                $q->where(
                    'resident_status',
                    $status
                );
            }
        );

        $perPage = min(
            (int) $request->input('per_page', 10),
            1000
        );

        $residents = $query
            ->latest()
            ->paginate($perPage);

        return ResidentResource::collection(
            $residents
        );
    }

    public function store(
        StoreResidentRequest $request
    ) {
        $data = $request->validated();

        if ($request->hasFile('ktp_photo')) {

            $data['ktp_photo'] =
                $request
                ->file('ktp_photo')
                ->store(
                    'ktp',
                    'public'
                );
        }

        $resident = Resident::create($data);

        return new ResidentResource(
            $resident
        );
    }

    public function show(Resident $resident)
    {
        return new ResidentResource(
            $resident
        );
    }

    public function update(
        UpdateResidentRequest $request,
        Resident $resident
    ) {
        $data = $request->validated();
        $removeKtpPhoto = in_array(
            strtolower((string) $request->input('remove_ktp_photo')),
            ['1', 'true', 'on', 'yes'],
            true
        );

        /*
         * REMOVE EXISTING KTP PHOTO
         */
        if (
            $removeKtpPhoto
            && $resident->ktp_photo
        ) {

            Storage::disk('public')
                ->delete(
                    $resident->ktp_photo
                );

            $data['ktp_photo'] = null;
        }

        /*
         * UPLOAD / REPLACE KTP PHOTO
         *
         * A new photo takes priority over
         * remove_ktp_photo.
         */
        if ($request->hasFile('ktp_photo')) {

            if ($resident->ktp_photo) {

                Storage::disk('public')
                    ->delete(
                        $resident->ktp_photo
                    );
            }

            $data['ktp_photo'] =
                $request
                ->file('ktp_photo')
                ->store(
                    'ktp',
                    'public'
                );
        }

        /*
         * Do not accidentally save the
         * control field into the database.
         */
        unset($data['remove_ktp_photo']);

        $resident->update($data);

        return new ResidentResource(
            $resident->fresh()
        );
    }

    public function destroy(
        Resident $resident
    ) {
        /*
         * Delete the stored KTP photo
         * before deleting the resident.
         */
        if ($resident->ktp_photo) {

            Storage::disk('public')
                ->delete(
                    $resident->ktp_photo
                );
        }

        $resident->delete();

        return response()->json([
            'message' =>
            'Resident deleted successfully.'
        ]);
    }
}
