<?php

class AppointmentModel {
    use Model;

    protected $table = 'appointments';

    public $errors = [];

    protected $allowedColumns = ['citizen_id', 'gn_id', 'preferred_date', 'preferred_time', 'service_type', 'description', 'documents', 'created_at', 'status', 'remarks'];

    // Validate input data
    public function validate($data) {
        $this->errors = [];

        // Validate preferred_date
        if (empty($data['preferred_date'])) {
            $this->errors['date'] = 'Preferred Date is required';
        } else {
            // Convert from localized date format to Y-m-d format for storage
            $dateObj = DateTime::createFromFormat('l, F j, Y', $data['preferred_date']);
            if (!$dateObj) {
                $this->errors['date'] = "Invalid date format.";
            } else {
                $formattedDate = $dateObj->format('Y-m-d');
                $data['preferred_date'] = $formattedDate; // Update the date to standardized format
                
                $currentDate = new DateTime();
                $currentDate->setTime(0, 0); // Normalize to midnight

                if ($dateObj < $currentDate) {
                    $this->errors['date'] = "Cannot book appointments in the past.";
                }

                $dayOfWeek = $dateObj->format('l');
                if (!in_array($dayOfWeek, ['Tuesday', 'Thursday', 'Saturday'])) {
                    $this->errors['date'] = "Appointments can only be booked on Tuesday, Thursday, or Saturday.";
                }
            }
        }

        // Validate preferred_time
        if (empty($data['preferred_time'])) {
            $this->errors['time'] = 'Preferred Time is required';
        } else {
            // Extract the time portion (e.g., "9:00 AM" -> "09:00")
            $timeParts = explode(' ', $data['preferred_time']);
            if (count($timeParts) >= 2) {
                $timeValue = $timeParts[0];
                $period = $timeParts[1];
                
                // Convert from 12-hour to 24-hour format
                $timeComponents = explode(':', $timeValue);
                $hour = (int)$timeComponents[0];
                $minute = isset($timeComponents[1]) ? (int)$timeComponents[1] : 0;
                
                if (strtoupper($period) === 'PM' && $hour < 12) {
                    $hour += 12;
                } else if (strtoupper($period) === 'AM' && $hour == 12) {
                    $hour = 0;
                }
                
                // Format as HH:MM
                $formattedTime = sprintf("%02d:%02d", $hour, $minute);
                $data['preferred_time'] = $formattedTime; // Update time to standard format
                
            } else {
                $this->errors['time'] = 'Invalid Time Format';
            }
        }
    }

    public function getAllAppointments($user_id) {
        $query = "SELECT * 
          FROM appointments
          WHERE citizen_id = :id ORDER BY created_at DESC";

        $params = ['id' => $user_id];

        return $this->query($query, $params) ?? null;
    }

    public function getNATimeSlots($date) {
        $query = "SELECT preferred_time
          FROM appointments
          WHERE preferred_date = :date";

        $params = ['date' => $date];

        $results = $this->query($query, $params) ?? null;

        $timeslots = [];
        if ($results) {
            foreach ($results as $result) {
                $timeslots[] = $result->preferred_time;
            }
        }

        return $timeslots;
    }

    public function saveAppointment($appointment) {
        $query = "INSERT INTO appointments(citizen_id, gn_id, application_id, permit_id, preferred_date, preferred_time, service_type, description, created_at) VALUES(:citizen_id, :gn_id, :application_id, :permit_id, :preferred_date, :preferred_time, :service_type, :description, :created_at)";
        $params = [
            'preferred_date' => $appointment['preferred_date'],
            'preferred_time' => $appointment['preferred_time'],
            'service_type' => $appointment['service_type'],
            'description' => $appointment['appointmentDescription'] ?? null,
            'created_at' => date('Y-m-d H:i:s'),
            'citizen_id' => $appointment['citizen_id'],
            'gn_id' => $appointment['gn_id'],
            'application_id' => empty($appointment['application_id']) ? null : $appointment['application_id'],
            'permit_id' => empty($appointment['permit_id']) ? null : $appointment['permit_id']
        ];

        $results = $this->query($query, $params) ?? null;

        return empty($this->errors);
    }

    public function getAppointmentsByGN($gnid) {
        $query = "SELECT * 
          FROM appointments
          WHERE gn_id = :id
          ORDER BY created_at DESC";

        $params = ['id' => $gnid];
        return $this->query($query, $params) ?? null;
    }

    public function updateAppointmentStatus($appointmentId, $status, $remarks) {
        $query = "UPDATE $this->table SET status = :status, remarks = :remarks WHERE appointment_id = :appointment_id";
        $params = [
            ':status' => $status,
            ':remarks' => $remarks,
            ':appointment_id' => $appointmentId
        ];

        return $this->query($query, $params);
    }

    public function deleteAppointment($appointmentId) {
        $query = "DELETE FROM $this->table WHERE appointment_id = :appointment_id";
        $params = [
            ':appointment_id' => $appointmentId
        ];

        return $this->query($query, $params);
    }

    public function getDate($appointmentId) {
        $query = "SELECT preferred_date FROM $this->table WHERE appointment_id = $appointmentId";
        return $this->query($query);
    }

    public function getAppointmentCitizen($appointmentId) {
        $query = "SELECT * FROM $this->table JOIN citizen ON citizen.citizen_id = $this->table.citizen_id WHERE $this->table.appointment_id = $appointmentId";
        return $this->query($query);
    }
}
