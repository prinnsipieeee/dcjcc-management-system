import { useEffect, useState } from "react";

export default function Dashboard() {
  const [stats, setStats] = useState({
    total: 0,
    guests: 0,
    firstTimers: 0,
  });

  useEffect(() => {
    fetch("http://localhost/dcjcc-management-system/backend/api/dash_stats.php")
      .then((res) => res.json())
      .then((data) => setStats(data));
  }, []);

  return (
    <div>

      {/* CARDS */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div className="bg-white p-4 shadow rounded">
          <h2 className="text-gray-500">Total Attendees</h2>
          <p className="text-2xl font-bold">{stats.total}</p>
        </div>

        <div className="bg-white p-4 shadow rounded">
          <h2 className="text-gray-500">Guests</h2>
          <p className="text-2xl font-bold">{stats.guests}</p>
        </div>

        <div className="bg-white p-4 shadow rounded">
          <h2 className="text-gray-500">First Timers</h2>
          <p className="text-2xl font-bold">{stats.firstTimers}</p>
        </div>

      </div>

    </div>
  );
}