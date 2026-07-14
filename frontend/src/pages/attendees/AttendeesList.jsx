import { useEffect, useState } from "react";

    export default function AttendeesList() {
        const [attendees, setAttendees] = useState([]);
        const [filters, setFilters] = useState({
            search: "",
            address: "",
            church: "",
            is_guest: "",
            is_first_timer: "",
        });

        const fetchAttendees = async () => {

            try {
                const query = new URLSearchParams(filters).toString();

                const res = await fetch(
                    `http://localhost/dcjcc-management-system/backend/api/get_attendee.php?${query}`
                );

                const data = await res.json();
                setAttendees(data);
            } catch (error) {
                console.error(error);
            }
        };
        useEffect(() => {
            fetchAttendees();
        }, [filters]);

       return (
        <div className="p-6">
            <h1 className="text-2xl font-bold mb-6">Attendees</h1>

            {/* FILTER CARD */}
            <div className="bg-white shadow rounded-lg p-4 mb-6">
            <h2 className="font-semibold mb-3">Filters</h2>

            <div className="grid grid-cols-1 md:grid-cols-5 gap-3">

                <input
                type="text"
                placeholder="Search Name"
                className="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                onChange={(e) =>
                    setFilters({ ...filters, search: e.target.value })
                }
                />

                <input
                type="text"
                placeholder="Address"
                className="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                onChange={(e) =>
                    setFilters({ ...filters, address: e.target.value })
                }
                />

                <input
                type="text"
                placeholder="Church"
                className="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                onChange={(e) =>
                    setFilters({ ...filters, church: e.target.value })
                }
                />

                <div className="flex items-center gap-4 col-span-2">
                <label className="flex items-center gap-2">
                    <input
                    type="checkbox"
                    onChange={(e) =>
                        setFilters({
                        ...filters,
                        is_guest: e.target.checked ? "1" : "",
                        })
                    }
                    />
                    <span>Guest</span>
                </label>

                <label className="flex items-center gap-2">
                    <input
                    type="checkbox"
                    onChange={(e) =>
                        setFilters({
                        ...filters,
                        is_first_timer: e.target.checked ? "1" : "",
                        })
                    }
                    />
                    <span>First Timer</span>
                </label>
                </div>

            </div>
            </div>

            {/* TABLE CARD */}
            <div className="bg-white shadow rounded-lg overflow-hidden">
            <table className="w-full text-sm">
                <thead className="bg-gray-100">
                <tr>
                    <th className="text-left p-3">Name</th>
                    <th className="text-left p-3">Address</th>
                    <th className="text-left p-3">Church</th>
                    <th className="text-left p-3">Guest</th>
                    <th className="text-left p-3">First Timer</th>
                </tr>
                </thead>

                <tbody>
                {attendees.length > 0 ? (
                    attendees.map((a) => (
                    <tr key={a.id} className="border-t hover:bg-gray-50">
                        <td className="p-3">{a.name}</td>
                        <td className="p-3">{a.address}</td>
                        <td className="p-3">{a.church_affiliation}</td>

                        <td className="p-3">
                        <span
                            className={`px-2 py-1 rounded text-xs ${
                            a.is_guest == 1
                                ? "bg-green-100 text-green-700"
                                : "bg-gray-200 text-gray-600"
                            }`}
                        >
                            {a.is_guest == 1 ? "Yes" : "No"}
                        </span>
                        </td>

                        <td className="p-3">
                        <span
                            className={`px-2 py-1 rounded text-xs ${
                            a.is_first_timer == 1
                                ? "bg-blue-100 text-blue-700"
                                : "bg-gray-200 text-gray-600"
                            }`}
                        >
                            {a.is_first_timer == 1 ? "Yes" : "No"}
                        </span>
                        </td>
                    </tr>
                    ))
                ) : (
                    <tr>
                    <td colSpan="5" className="text-center p-4 text-gray-500">
                        No attendees found
                    </td>
                    </tr>
                )}
                </tbody>
            </table>
            </div>
        </div>
        );
    } 