import { Outlet, NavLink } from "react-router-dom";
import { useState } from "react";

export default function DashboardLayout() {
  const [open, setOpen] = useState(false);

  return (
    <div className="flex h-screen bg-gray-100">

      {/* MOBILE OVERLAY */}
      {open && (
        <div
          className="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
          onClick={() => setOpen(false)}
        ></div>
      )}

      {/* SIDEBAR */}
      <div
        className={`fixed md:static z-50 top-0 left-0 h-full w-64 bg-gray-900 text-white p-4 transform transition-transform duration-300
        ${open ? "translate-x-0" : "-translate-x-full"} md:translate-x-0`}
      >
        <h1 className="text-xl font-bold mb-6">DCJCC</h1>

        <nav className="flex flex-col gap-2">

          <NavLink
            to="/dashboard"
            className={({ isActive }) =>
              isActive
                ? "bg-gray-700 p-2 rounded"
                : "hover:bg-gray-700 p-2 rounded"
            }
            onClick={() => setOpen(false)}
          >
            Dashboard
          </NavLink>

          <NavLink
            to="/attendees"
            className={({ isActive }) =>
              isActive
                ? "bg-gray-700 p-2 rounded"
                : "hover:bg-gray-700 p-2 rounded"
            }
            onClick={() => setOpen(false)}
          >
            Attendees
          </NavLink>

        </nav>
      </div>

      {/* MAIN */}
      <div className="flex-1 flex flex-col">

        {/* HEADER */}
        <div className="bg-white shadow p-4 flex justify-between items-center">

          {/* MENU BUTTON (MOBILE) */}
          <button
            className="md:hidden text-gray-700"
            onClick={() => setOpen(true)}
          >
            ☰
          </button>

          <h2 className="font-semibold">Admin Panel</h2>

          <span className="text-sm text-gray-600">User</span>
        </div>

        {/* CONTENT */}
        <div className="p-4 md:p-6 overflow-y-auto flex-1">
          <Outlet />
        </div>

      </div>
    </div>
  );
}