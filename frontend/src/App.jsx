import { BrowserRouter, Routes, Route } from "react-router-dom";

import AttendeeForm from "./pages/attendees/AttendeeForm";
import AttendeesList from "./pages/attendees/AttendeesList";
import DashboardLayout from "./layouts/DashboardLayout";
import Dashboard from "./pages/dashboard/Dashboard";

function App() {
  return (
    <BrowserRouter>
      <Routes>

        <Route path="/" element={<DashboardLayout />}>
          <Route index element={<Dashboard />}/>
          <Route path="dashboard" element={<Dashboard />} /> 
          <Route path="attendees" element={<AttendeesList />} />
          <Route path="/attendees/create" element={<AttendeeForm />}></Route>
        </Route>

      </Routes>
    </BrowserRouter>
  );
}

export default App;