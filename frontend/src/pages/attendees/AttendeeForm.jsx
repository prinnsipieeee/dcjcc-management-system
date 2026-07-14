import { useState } from "react";

    export default function AttendeeForm() {
        const [form, setForm] = useState({
            name: "",
            address: "",
            church_affiliation: "",
            is_first_timer: 0,
            is_guest: 0,
        });

        const handleChange = (e) => {
            const {name, value, type, checked} = e.target;

            setForm((prev) => ({
                ...prev,
                [name]: type === "chekbox" ? (checked ? 1 : 0) : value,
            }));
        };

        const handleSubmit = async (e) => {
            e.preventDefault();
        
        try {
            const res = await fetch (
                "http://localhost/dcjcc-management-system/backend/api/add_attendee.php",
                {
                    method: "POST",
                    header: {
                        "content-Type": "application/json",
                    },
                    body: JSON.stringify(form),
                }
            );

            const data = await res.json();

            alert("Attendee Added!");

            //reset form
            setForm({
                name: "",
                address: "",
                church_affiliation: "",
                is_first_timer: 0,
                is_guest: 0,
            });

        } catch (err) {
            console.error(err)
            alert("Erro Adding Attendee");
        }
    };

    return(
        <div className="max-w-l mx-auto bg-white p-6 shadow">
            <h2 className="text-xl font-bold mb-4">Add Attendee</h2>

            <form onSubmit={handleSubmit} className="space-y-3">
                <input
                name="name"
                value={form.name}
                onChange={handleChange}
                placeholder="Full Name"  
                className="w-full border p-2" 
                required
                />

                <input
                name="address"
                value={form.address}
                onChange={handleChange}
                placeholder="Address"
                className="w-full border p-2"
                required 
                />

                <input
                name="church_affiliation"
                value={form.church_affiliation}
                onChange={handleChange}
                placeholder="Church"
                className="w-full border p-2"
                />
                
                <div className= "flex gap-4">
                    <label className="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="is_first_timer"
                            checked={form.is_first_timer === 1}
                            onChange={(e) =>
                                setForm({
                                    ...form,
                                    is_first_timer: e.target.checked ? 1 : 0.
                                })
                            }
                        />
                        First Timer
                    </label>

                    <label className="flex items-center gap-2">
                        <input 
                        type="checkbox"
                        name="is_guest"
                        checked={form.is_guest === 1}
                        onChange={(e) => 
                            setForm({
                                ...form,
                                is_guest: e.target.checked ? 1 : 0,
                            })
                        }
                        />
                        Guest
                    </label>
                </div>

                <button 
                type="submit"
                className="bg-blue-500 text-white px-4 py-2 w-full"
                >
                    Submit
                </button>
            </form>
        </div>
    )
}

    