import React from 'react';
import { Button } from '@/components/ui/button';
import { router } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import Heading from '@/components/heading';

interface Props {
    count: number;
    [key: string]: unknown;
}

export default function Welcome({ count }: Props) {
    const handleIncrement = () => {
        router.post(route('counter.store'), { action: 'increment' }, {
            preserveState: true,
            preserveScroll: true
        });
    };

    const handleDecrement = () => {
        router.post(route('counter.store'), { action: 'decrement' }, {
            preserveState: true,
            preserveScroll: true
        });
    };

    return (
        <AppShell>
            <div className="flex min-h-screen items-center justify-center bg-gray-50 dark:bg-gray-900">
                <div className="max-w-md w-full mx-auto p-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                    <div className="text-center">
                        <Heading title="Counter App" />
                        
                        <div className="mb-8">
                            <div className="text-6xl font-bold text-blue-600 dark:text-blue-400 mb-4">
                                {count}
                            </div>
                            <p className="text-gray-600 dark:text-gray-400">Current Count</p>
                        </div>
                        
                        <div className="flex gap-4 justify-center">
                            <Button 
                                onClick={handleDecrement}
                                variant="outline"
                                size="lg"
                                className="px-8"
                            >
                                - Decrement
                            </Button>
                            <Button 
                                onClick={handleIncrement}
                                size="lg"
                                className="px-8"
                            >
                                + Increment
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}