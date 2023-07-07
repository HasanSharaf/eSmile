<?php

namespace Modules\Doctor\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Doctor\Entities\Doctor;
use Laravel\Sanctum\PersonalAccessToken;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Modules\Session\Entities\Session;
use Modules\Session\Models\EPaymentType;

class DoctorRepository extends EloquentBaseRepository
{
    /**
    * Create Doctor (Register)
    * @return Doctor
    */
    public function registerDoctor($data)
    {
        $doctor = Doctor::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'phone_number' => $data['phone_number'],
            'birthday' => $data['birthday'],
            'location' => $data['location'],
            'location_details' => $data['location_details'],
            'years_of_experience' => $data['years_of_experience'],
        ]);
    
        if ($data->hasFile('doctor_picture') && $data->file('doctor_picture')->isValid()) {
            $doctorPicture = $data->file('doctor_picture');
            $extension = $doctorPicture->getClientOriginalExtension();
            $pictureName = uniqid('doctorPic') . '.' . $extension;
            $doctorPicture->storeAs('public/pictures', $pictureName);
            $doctor->doctor_picture = 'pictures/' . $pictureName;
            $doctor->save();
        }
        
        return $doctor;
    }
    
  

    /**
    * Login Doctor
    * @return Doctor
    */
    public  function loginDoctor($request)
    {
        $doctor = Doctor::where('email', $request['email'])->first();
        return $doctor;
    }

    /**
    * Logout Doctor
    * @return Doctor
    */
    public  function logoutDoctor()
    {
        $logout = Auth::logout();
        return $logout;
    }

    /**
    * Update Doctor
    * @return Doctor
    */
    public function updateDoctor($data, $doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $doctor->first_name = $data['first_name'] ?? $doctor->first_name;
        $doctor->last_name = $data['last_name'] ?? $doctor->last_name;
        $doctor->email = $data['email'] ?? $doctor->email;
        $doctor->password = Hash::make($data['password']) ?? $doctor->password;
        $doctor->gender = $data['gender'] ?? $doctor->gender;
        $doctor->phone_number = $data['phone_number'] ?? $doctor->phone_number;
        $doctor->location = $data['location'] ?? $doctor->location;
        $doctor->location_details = $data['location_details'] ?? $doctor->location_details;
        $doctor->birthday = $data['birthday'] ?? $doctor->birthday;

        if (isset($data['doctor_picture']) && $data['doctor_picture']->isValid()) {
            // Delete the previous doctor picture if it exists
            if ($doctor->doctor_picture && Storage::exists('public/' . $doctor->doctor_picture)) {
                Storage::delete('public/' . $doctor->doctor_picture);
            }

            $extension = $data['doctor_picture']->getClientOriginalExtension();
            $pictureName = uniqid('doctorPic') . '.' . $extension;
            $data['doctor_picture']->storeAs('public/pictures', $pictureName);
            $doctor->doctor_picture = 'pictures/' . $pictureName;
        }

        $doctor->save();
        return $doctor;
    }



    /**
    * Delete Doctor
    * @param int $doctorId
    * @return bool
    */
    public function deleteDoctor($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        
        // Delete the doctor's picture if it exists
        if ($doctor->doctor_picture && Storage::exists($doctor->doctor_picture)) {
            Storage::delete($doctor->doctor_picture);
        }
        
        // Delete the doctor
        $doctor->delete();
        
        return true;
    }

    /**
     * Get Doctor Query.
     * @param Doctor
     */
    public function getDoctorQuery()
    {
        return Doctor::first();
    }

    /**
     * Get Pagination Data By Query.
     *
     */
    public  function getPaginationDataByQuery($data, $query)
    {
        $result = $query->paginate($data['per_page']);
        return $result;
    }

    /**
     * Get last inserted doctor.
     * @return Doctor
     */
    public function getLastDoctor()
    {
        $doctor = Doctor::orderBy('id')->first();
        return $doctor;
    }

    /**
     * Get All Doctors.
     * @return Doctor
     */
    public function getAllDoctors($data, $query)
    {
        return $query->paginate($data['per_page']);
    }

    /**
     * Get Doctor By Id.
     * @return Doctor
     */
    public function getDoctorById($data,$doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        return $doctor;
    }

    // /**
    // * Get Enable Financial Account Doctor
    // * @return Doctor
    // */
    // public function getEnableFinancialDoctor($data, $query)
    // {
    //     $excludedDoctorIds = DB::table('financial_accounts')->pluck('doctor_id');
    //     return $query->whereNotIn('id', $excludedDoctorIds)->paginate($data['per_page']);    
    // }
    
}
